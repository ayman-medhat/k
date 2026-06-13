import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../features/dashboard/app_shell.dart';
import '../features/dashboard/dashboard_screen.dart';
import '../features/auth/login_screen.dart';
import '../features/leads/leads_list_screen.dart';
import '../features/leads/lead_form_screen.dart';
import '../features/contacts/contacts_list_screen.dart';
import '../features/students/students_list_screen.dart';
import '../features/grades/grades_screen.dart';
import '../features/subjects/subjects_screen.dart';
import '../features/attendance/attendance_list_screen.dart';
import '../features/exams/exams_list_screen.dart';
import '../features/enrollments/enrollments_list_screen.dart';
import '../features/school/school_screen.dart';
import '../features/users/users_screen.dart';
import '../providers/providers.dart';

final routerProvider = Provider<GoRouter>((ref) {
  debugPrint('ROUTER provider build started');
  final authState = ref.watch(authStateProvider);
  debugPrint('ROUTER authState: $authState');

  return GoRouter(
    initialLocation: '/dashboard',
    redirect: (context, state) {
      final isLoggedIn = authState.valueOrNull != null;
      final isLoginRoute = state.matchedLocation == '/login';
      debugPrint('ROUTER redirect: isLoggedIn=$isLoggedIn isLoginRoute=$isLoginRoute location=${state.matchedLocation}');

      if (!isLoggedIn && !isLoginRoute) return '/login';
      if (isLoggedIn && isLoginRoute) return '/dashboard';
      return null;
    },
    routes: [
      GoRoute(
        path: '/login',
        builder: (context, state) => const LoginScreen(),
      ),
      ShellRoute(
        builder: (context, state, child) => AppShell(child: child),
        routes: [
          GoRoute(
            path: '/dashboard',
            builder: (context, state) => const DashboardScreen(),
          ),
          GoRoute(
            path: '/leads',
            builder: (context, state) => const LeadsListScreen(),
            routes: [
              GoRoute(
                path: 'create',
                builder: (context, state) => const LeadFormScreen(),
              ),
              GoRoute(
                path: ':id/edit',
                builder: (context, state) => LeadFormScreen(
                  leadId: int.parse(state.pathParameters['id']!),
                ),
              ),
            ],
          ),
          GoRoute(
            path: '/contacts',
            builder: (context, state) => const ContactsListScreen(),
          ),
          GoRoute(
            path: '/students',
            builder: (context, state) => const StudentsListScreen(),
          ),
          GoRoute(
            path: '/grades',
            builder: (context, state) => const GradesScreen(),
          ),
          GoRoute(
            path: '/subjects',
            builder: (context, state) => const SubjectsScreen(),
          ),
          GoRoute(
            path: '/sections',
            builder: (context, state) => const Placeholder(),
          ),
          GoRoute(
            path: '/stages',
            builder: (context, state) => const Placeholder(),
          ),
          GoRoute(
            path: '/grade-subjects',
            builder: (context, state) => const Placeholder(),
          ),
          GoRoute(
            path: '/academic-years',
            builder: (context, state) => const Placeholder(),
          ),
          GoRoute(
            path: '/terms',
            builder: (context, state) => const Placeholder(),
          ),
          GoRoute(
            path: '/enrollments',
            builder: (context, state) => const EnrollmentsListScreen(),
          ),
          GoRoute(
            path: '/attendance',
            builder: (context, state) => const AttendanceListScreen(),
            routes: [
              GoRoute(
                path: 'take',
                builder: (context, state) => const TakeAttendanceScreen(),
              ),
            ],
          ),
          GoRoute(
            path: '/exams',
            builder: (context, state) => const ExamsListScreen(),
          ),
          GoRoute(
            path: '/school',
            builder: (context, state) => const SchoolScreen(),
          ),
          GoRoute(
            path: '/users',
            builder: (context, state) => const UsersScreen(),
          ),
        ],
      ),
    ],
  );
});
