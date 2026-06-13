import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import '../core/network/api_client.dart';
import '../services/auth_service.dart';
import '../services/api_service.dart';
import '../models/user.dart';
import '../models/lead.dart';
import '../models/contact.dart';
import '../models/grade.dart';
import '../models/subject.dart';
import '../models/section.dart';
import '../models/stage.dart';
import '../models/student.dart';

final apiClientProvider = Provider<ApiClient>((ref) => ApiClient());
final secureStorageProvider = Provider<FlutterSecureStorage>((ref) => const FlutterSecureStorage());

final authServiceProvider = Provider<AuthService>((ref) => AuthService(ref.read(apiClientProvider)));
final apiServiceProvider = Provider<ApiService>((ref) => ApiService(ref.read(apiClientProvider)));

final authStateProvider = StateNotifierProvider<AuthStateNotifier, AsyncValue<User?>>((ref) {
  return AuthStateNotifier(ref.read(authServiceProvider));
});

class AuthStateNotifier extends StateNotifier<AsyncValue<User?>> {
  final AuthService _authService;

  AuthStateNotifier(this._authService) : super(const AsyncValue.data(null));

  Future<void> login(String email, String password) async {
    state = const AsyncValue.loading();
    state = await AsyncValue.guard(() async {
      final result = await _authService.login(email, password);
      return result.user;
    });
  }

  Future<void> checkAuth() async {
    final hasToken = await _authService.hasToken();
    if (hasToken) {
      state = await AsyncValue.guard(() => _authService.getUser());
    }
  }

  Future<void> logout() async {
    await _authService.logout();
    state = const AsyncValue.data(null);
  }
}

final dashboardProvider = FutureProvider<Map<String, dynamic>>((ref) async {
  return ref.read(apiServiceProvider).getDashboard();
});

final leadsProvider = FutureProvider.family<({List<Lead> data, int total}), ({String? category, String? search, int page})>((ref, params) async {
  return ref.read(apiServiceProvider).getLeads(
    category: params.category,
    search: params.search,
    page: params.page,
  );
});

final contactsProvider = FutureProvider.family<({List<Contact> data, int total}), ({String? category, String? search, int page})>((ref, params) async {
  return ref.read(apiServiceProvider).getContacts(
    category: params.category,
    search: params.search,
    page: params.page,
  );
});

final gradesProvider = FutureProvider<List<Grade>>((ref) async {
  return ref.read(apiServiceProvider).getGrades();
});

final subjectsProvider = FutureProvider<List<Subject>>((ref) async {
  return ref.read(apiServiceProvider).getSubjects();
});

final sectionsProvider = FutureProvider.family<List<Section>, int?>((ref, gradeId) async {
  return ref.read(apiServiceProvider).getSections(gradeId: gradeId);
});

final stagesProvider = FutureProvider<List<Stage>>((ref) async {
  return ref.read(apiServiceProvider).getStages();
});

final studentsProvider = FutureProvider.family<({List<Student> data}), ({String? search, int page})>((ref, params) async {
  return ref.read(apiServiceProvider).getStudents(search: params.search, page: params.page);
});
