import 'enrollment.dart';

class Attendance {
  final int id;
  final int studentId;
  final int sectionId;
  final String date;
  final String status;
  final String? notes;
  final int? createdBy;
  final String? createdAt;
  final StudentBrief? student;

  Attendance({
    required this.id,
    required this.studentId,
    required this.sectionId,
    required this.date,
    required this.status,
    this.notes,
    this.createdBy,
    this.createdAt,
    this.student,
  });

  factory Attendance.fromJson(Map<String, dynamic> json) => Attendance(
    id: json['id'],
    studentId: json['student_id'],
    sectionId: json['section_id'],
    date: json['date'] ?? '',
    status: json['status'] ?? 'present',
    notes: json['notes'],
    createdBy: json['created_by'],
    createdAt: json['created_at'],
    student: json['student'] != null ? StudentBrief.fromJson(json['student']) : null,
  );

  Map<String, dynamic> toJson() => {
    'student_id': studentId,
    'section_id': sectionId,
    'date': date,
    'status': status,
    'notes': notes,
  };
}
