import '../core/network/api_client.dart';
import '../core/constants/api_constants.dart';
import '../models/user.dart';

class AuthService {
  final ApiClient _client;

  AuthService(this._client);

  Future<({User user, String token})> login(String email, String password) async {
    final response = await _client.post(ApiConstants.login, data: {
      'email': email,
      'password': password,
    });

    final data = response.data;
    await _client.setToken(data['token']);

    return (
      user: User.fromJson(data['user']),
      token: data['token'] as String,
    );
  }

  Future<User> register(String name, String email, String password, String passwordConfirmation) async {
    final response = await _client.post(ApiConstants.register, data: {
      'name': name,
      'email': email,
      'password': password,
      'password_confirmation': passwordConfirmation,
    });

    final data = response.data;
    await _client.setToken(data['token']);

    return User.fromJson(data['user']);
  }

  Future<User> getUser() async {
    final response = await _client.get(ApiConstants.user);
    return User.fromJson(response.data);
  }

  Future<void> logout() async {
    await _client.post(ApiConstants.logout);
    await _client.clearToken();
  }

  Future<bool> hasToken() async {
    final token = await _client.getToken();
    return token != null;
  }
}
