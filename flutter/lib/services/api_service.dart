import '../core/network/api_client.dart';
import '../core/constants/api_constants.dart';
import '../models/lead.dart';
import '../models/contact.dart';
import '../models/student.dart';
import '../models/grade.dart';
import '../models/subject.dart';
import '../models/section.dart';
import '../models/stage.dart';
import '../models/academic_year.dart';
import '../models/term.dart';
import '../models/enrollment.dart';
import '../models/attendance.dart';
import '../models/exam.dart';
import '../models/school.dart';
import '../models/user.dart';

class ApiService {
  final ApiClient _client;

  ApiService(this._client);

  Future<Map<String, dynamic>> getDashboard() async {
    final response = await _client.get(ApiConstants.dashboard);
    final stats = response.data['stats'];
    if (stats is Map) return Map<String, dynamic>.from(stats);
    return {};
  }

  Future<({List<Lead> data, int total})> getLeads({String? category, String? search, int page = 1, int perPage = 10}) async {
    final response = await _client.get(ApiConstants.leads, queryParams: {
      if (category != null && category != 'All') 'category': category,
      if (search != null) 'search': search,
      'page': page,
      'per_page': perPage,
    });
    final data = response.data['data'];
    return (
      data: (data['data'] as List).map((e) => Lead.fromJson(e)).toList(),
      total: (data['total'] ?? 0) as int,
    );
  }

  Future<Lead> getLead(int id) async {
    final response = await _client.get('${ApiConstants.leads}/$id');
    return Lead.fromJson(response.data['data']);
  }

  Future<Lead> createLead(Map<String, dynamic> data) async {
    final response = await _client.post(ApiConstants.leads, data: data);
    return Lead.fromJson(response.data['data']);
  }

  Future<Lead> updateLead(int id, Map<String, dynamic> data) async {
    final response = await _client.put('${ApiConstants.leads}/$id', data: data);
    return Lead.fromJson(response.data['data']);
  }

  Future<void> deleteLead(int id) async {
    await _client.delete('${ApiConstants.leads}/$id');
  }

  Future<Contact> acceptLead(int id) async {
    final response = await _client.post('${ApiConstants.leads}/$id/accept');
    return Contact.fromJson(response.data['data']);
  }

  Future<({List<Contact> data, int total})> getContacts({String? category, String? search, int page = 1, int perPage = 10}) async {
    final response = await _client.get(ApiConstants.contacts, queryParams: {
      if (category != null && category != 'All') 'category': category,
      if (search != null) 'search': search,
      'page': page,
      'per_page': perPage,
    });
    final data = response.data['data'];
    return (
      data: (data['data'] as List).map((e) => Contact.fromJson(e)).toList(),
      total: (data['total'] ?? 0) as int,
    );
  }

  Future<Contact> getContact(int id) async {
    final response = await _client.get('${ApiConstants.contacts}/$id');
    return Contact.fromJson(response.data['data']);
  }

  Future<Contact> createContact(Map<String, dynamic> data) async {
    final response = await _client.post(ApiConstants.contacts, data: data);
    return Contact.fromJson(response.data['data']);
  }

  Future<Contact> updateContact(int id, Map<String, dynamic> data) async {
    final response = await _client.put('${ApiConstants.contacts}/$id', data: data);
    return Contact.fromJson(response.data['data']);
  }

  Future<void> deleteContact(int id) async {
    await _client.delete('${ApiConstants.contacts}/$id');
  }

  Future<Lead> restoreContact(int id) async {
    final response = await _client.post('${ApiConstants.contacts}/$id/restore');
    return Lead.fromJson(response.data['data']);
  }

  Future<({List<Student> data})> getStudents({String? search, int page = 1, int perPage = 20}) async {
    final response = await _client.get(ApiConstants.students, queryParams: {
      if (search != null) 'search': search,
      'page': page,
      'per_page': perPage,
    });
    final data = response.data['data'];
    return (
      data: (data['data'] as List).map((e) => Student.fromJson(e)).toList(),
    );
  }

  Future<Student> getStudent(int id) async {
    final response = await _client.get('${ApiConstants.students}/$id');
    return Student.fromJson(response.data['data']);
  }

  Future<Student> createStudent(Map<String, dynamic> data) async {
    final response = await _client.post(ApiConstants.students, data: data);
    return Student.fromJson(response.data['data']);
  }

  Future<Student> updateStudent(int id, Map<String, dynamic> data) async {
    final response = await _client.put('${ApiConstants.students}/$id', data: data);
    return Student.fromJson(response.data['data']);
  }

  Future<void> deleteStudent(int id) async {
    await _client.delete('${ApiConstants.students}/$id');
  }

  Future<List<Grade>> getGrades() async {
    final response = await _client.get(ApiConstants.grades);
    return (response.data['data'] as List).map((e) => Grade.fromJson(e)).toList();
  }

  Future<List<Subject>> getSubjects() async {
    final response = await _client.get(ApiConstants.subjects);
    return (response.data['data'] as List).map((e) => Subject.fromJson(e)).toList();
  }

  Future<List<Section>> getSections({int? gradeId}) async {
    final response = await _client.get(ApiConstants.sections, queryParams: {
      if (gradeId != null) 'grade_id': gradeId,
    });
    return (response.data['data'] as List).map((e) => Section.fromJson(e)).toList();
  }

  Future<List<Stage>> getStages() async {
    final response = await _client.get(ApiConstants.stages);
    return (response.data['data'] as List).map((e) => Stage.fromJson(e)).toList();
  }

  Future<List<AcademicYear>> getAcademicYears() async {
    final response = await _client.get(ApiConstants.academicYears);
    return (response.data['data'] as List).map((e) => AcademicYear.fromJson(e)).toList();
  }

  Future<List<Term>> getTerms({int? academicYearId}) async {
    final response = await _client.get(ApiConstants.terms, queryParams: {
      if (academicYearId != null) 'academic_year_id': academicYearId,
    });
    return (response.data['data'] as List).map((e) => Term.fromJson(e)).toList();
  }

  Future<({List<Enrollment> data})> getEnrollments({int? academicYearId, int? gradeId, String? status, int page = 1, int perPage = 20}) async {
    final response = await _client.get(ApiConstants.enrollments, queryParams: {
      if (academicYearId != null) 'academic_year_id': academicYearId,
      if (gradeId != null) 'grade_id': gradeId,
      if (status != null) 'status': status,
      'page': page,
      'per_page': perPage,
    });
    final data = response.data['data'];
    return (
      data: (data['data'] as List).map((e) => Enrollment.fromJson(e)).toList(),
    );
  }

  Future<({List<Attendance> data})> getAttendance({int? sectionId, int? gradeId, String? status, String? dateFrom, String? dateTo, int page = 1, int perPage = 30}) async {
    final response = await _client.get(ApiConstants.attendance, queryParams: {
      if (sectionId != null) 'section_id': sectionId,
      if (gradeId != null) 'grade_id': gradeId,
      if (status != null) 'status': status,
      if (dateFrom != null) 'date_from': dateFrom,
      if (dateTo != null) 'date_to': dateTo,
      'page': page,
      'per_page': perPage,
    });
    final data = response.data['data'];
    return (
      data: (data['data'] as List).map((e) => Attendance.fromJson(e)).toList(),
    );
  }

  Future<List<Map<String, dynamic>>> getAttendanceStudents(int sectionId, String date) async {
    final response = await _client.get('${ApiConstants.attendance}/students', queryParams: {
      'section_id': sectionId,
      'date': date,
    });
    return List<Map<String, dynamic>>.from(response.data['data']);
  }

  Future<void> takeAttendance(int sectionId, String date, List<Map<String, dynamic>> records) async {
    await _client.post('${ApiConstants.attendance}/take', data: {
      'section_id': sectionId,
      'date': date,
      'records': records,
    });
  }

  Future<List<Exam>> getExams({int? gradeId, int? termId}) async {
    final response = await _client.get(ApiConstants.exams, queryParams: {
      if (gradeId != null) 'grade_id': gradeId,
      if (termId != null) 'term_id': termId,
    });
    return (response.data['data'] as List).map((e) => Exam.fromJson(e)).toList();
  }

  Future<Exam> getExam(int id) async {
    final response = await _client.get('${ApiConstants.exams}/$id');
    return Exam.fromJson(response.data['data']);
  }

  Future<Map<String, dynamic>> getExamMarks(int examId) async {
    final response = await _client.get('${ApiConstants.exams}/$examId/marks');
    return Map<String, dynamic>.from(response.data['data']);
  }

  Future<void> saveExamMarks(int examId, List<Map<String, dynamic>> marks) async {
    await _client.post('${ApiConstants.exams}/$examId/marks', data: {'marks': marks});
  }

  Future<School?> getSchool() async {
    try {
      final response = await _client.get(ApiConstants.school);
      return School.fromJson(response.data['data']);
    } catch (_) {
      return null;
    }
  }

  Future<School> updateSchool(Map<String, dynamic> data) async {
    final response = await _client.put(ApiConstants.school, data: data);
    return School.fromJson(response.data['data']);
  }

  Future<List<User>> getUsers() async {
    final response = await _client.get(ApiConstants.users);
    return (response.data['data'] as List).map((e) => User.fromJson(e)).toList();
  }

  Future<List<Grade>> getGradeSubjects() async {
    final response = await _client.get(ApiConstants.gradeSubjects);
    return (response.data['data'] as List).map((e) => Grade.fromJson(e)).toList();
  }

  Future<void> assignSubjectsToGrade(int gradeId, List<int> subjectIds) async {
    await _client.post('${ApiConstants.gradeSubjects}/assign', data: {
      'grade_id': gradeId,
      'subject_ids': subjectIds,
    });
  }

  Future<void> removeSubjectsFromGrade(int gradeId, List<int> subjectIds) async {
    await _client.post('${ApiConstants.gradeSubjects}/remove', data: {
      'grade_id': gradeId,
      'subject_ids': subjectIds,
    });
  }

  Future<void> setCurrentAcademicYear(int id) async {
    await _client.post('${ApiConstants.academicYears}/$id/set-current');
  }

  Future<void> setCurrentTerm(int id) async {
    await _client.post('${ApiConstants.terms}/$id/set-current');
  }

  Future<Section> createSection(Map<String, dynamic> data) async {
    final response = await _client.post(ApiConstants.sections, data: data);
    return Section.fromJson(response.data['data']);
  }

  Future<void> generateSections(int gradeId, int count) async {
    await _client.post('${ApiConstants.sections}/generate', data: {
      'grade_id': gradeId,
      'count': count,
    });
  }

  // Generic CRUD helpers for admin
  Future<dynamic> create(ApiConstants, String path, Map<String, dynamic> data) async {
    final response = await _client.post(path, data: data);
    return response.data;
  }

  Future<dynamic> update(String path, Map<String, dynamic> data) async {
    final response = await _client.put(path, data: data);
    return response.data;
  }

  Future<void> delete(String path) async {
    await _client.delete(path);
  }
}
