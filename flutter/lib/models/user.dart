class User {
  final int id;
  final String name;
  final String email;
  final String? role;

  User({
    required this.id,
    required this.name,
    required this.email,
    this.role,
  });

  factory User.fromJson(Map<String, dynamic> json) => User(
    id: json['id'],
    name: json['name'],
    email: json['email'],
    role: json['role'],
  );

  Map<String, dynamic> toJson() => {
    'id': id,
    'name': name,
    'email': email,
    'role': role,
  };

  bool get isAdmin => role == null || role == 'admin';
  bool get isHr => role == 'hr';
  bool get isStudentAffairs => role == 'student_affairs';
  bool get isAcademic => role == 'academic';
  bool get isControl => role == 'control';
}
