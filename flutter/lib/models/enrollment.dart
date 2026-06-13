import 'student.dart';

class Enrollment {
  final int id;
  final int studentId;
  final int academicYearId;
  final int gradeId;
  final int? sectionId;
  final String? enrolledAt;
  final String status;
  final StudentBrief? student;
  final AcademicYearBrief? academicYear;
  final GradeBrief? grade;
  final SectionBrief? section;

  Enrollment({
    required this.id,
    required this.studentId,
    required this.academicYearId,
    required this.gradeId,
    this.sectionId,
    this.enrolledAt,
    this.status = 'active',
    this.student,
    this.academicYear,
    this.grade,
    this.section,
  });

  factory Enrollment.fromJson(Map<String, dynamic> json) => Enrollment(
    id: json['id'],
    studentId: json['student_id'],
    academicYearId: json['academic_year_id'],
    gradeId: json['grade_id'],
    sectionId: json['section_id'],
    enrolledAt: json['enrolled_at'],
    status: json['status'] ?? 'active',
    student: json['student'] != null ? StudentBrief.fromJson(json['student']) : null,
    academicYear: json['academic_year'] != null ? AcademicYearBrief.fromJson(json['academic_year']) : null,
    grade: json['grade'] != null ? GradeBrief.fromJson(json['grade']) : null,
    section: json['section'] != null ? SectionBrief.fromJson(json['section']) : null,
  );

  Map<String, dynamic> toJson() => {
    'student_id': studentId,
    'academic_year_id': academicYearId,
    'grade_id': gradeId,
    'section_id': sectionId,
    'enrolled_at': enrolledAt,
    'status': status,
  };
}

class StudentBrief {
  final int id;
  final int? contactId;
  final ContactBriefForEnrollment? contact;

  StudentBrief({required this.id, this.contactId, this.contact});

  factory StudentBrief.fromJson(Map<String, dynamic> json) => StudentBrief(
    id: json['id'],
    contactId: json['contact_id'],
    contact: json['contact'] != null ? ContactBriefForEnrollment.fromJson(json['contact']) : null,
  );
}

class ContactBriefForEnrollment {
  final String nameEn;
  ContactBriefForEnrollment({required this.nameEn});
  factory ContactBriefForEnrollment.fromJson(Map<String, dynamic> json) =>
    ContactBriefForEnrollment(nameEn: json['nameEn'] ?? '');
}

class AcademicYearBrief {
  final int id;
  final String name;
  AcademicYearBrief({required this.id, required this.name});
  factory AcademicYearBrief.fromJson(Map<String, dynamic> json) =>
    AcademicYearBrief(id: json['id'], name: json['name'] ?? '');
}
