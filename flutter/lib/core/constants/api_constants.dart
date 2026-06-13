class ApiConstants {
  static const String baseUrl = String.fromEnvironment(
    'API_URL',
    defaultValue: 'http://localhost:8000/api',
  );

  static const String login = 'login';
  static const String register = 'register';
  static const String logout = 'logout';
  static const String user = 'user';
  static const String dashboard = 'dashboard';

  static const String leads = 'leads';
  static const String contacts = 'contacts';
  static const String students = 'students';
  static const String grades = 'grades';
  static const String subjects = 'subjects';
  static const String sections = 'sections';
  static const String stages = 'stages';
  static const String gradeSubjects = 'grade-subjects';
  static const String academicYears = 'academic-years';
  static const String terms = 'terms';
  static const String enrollments = 'enrollments';
  static const String attendance = 'attendance';
  static const String exams = 'exams';
  static const String school = 'school';
  static const String users = 'users';
}
