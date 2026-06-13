import 'student.dart';

class Exam {
  final int id;
  final String name;
  final int gradeId;
  final int termId;
  final String? date;
  final String? description;
  final String? createdAt;
  final GradeBrief? grade;
  final TermBrief? term;
  final List<ExamSubject>? subjects;

  Exam({
    required this.id,
    required this.name,
    required this.gradeId,
    required this.termId,
    this.date,
    this.description,
    this.createdAt,
    this.grade,
    this.term,
    this.subjects,
  });

  factory Exam.fromJson(Map<String, dynamic> json) => Exam(
    id: json['id'],
    name: json['name'] ?? '',
    gradeId: json['grade_id'],
    termId: json['term_id'],
    date: json['date'],
    description: json['description'],
    createdAt: json['created_at'],
    grade: json['grade'] != null ? GradeBrief.fromJson(json['grade']) : null,
    term: json['term'] != null ? TermBrief.fromJson(json['term']) : null,
    subjects: json['subjects'] != null
        ? (json['subjects'] as List).map((e) => ExamSubject.fromJson(e)).toList()
        : null,
  );

  Map<String, dynamic> toJson() => {
    'name': name,
    'grade_id': gradeId,
    'term_id': termId,
    'date': date,
    'description': description,
    'subjects': subjects?.map((e) => e.toJson()).toList(),
  };
}

class ExamSubject {
  final int id;
  final String name;
  final double? maxMarks;
  final String? pivot;

  ExamSubject({required this.id, required this.name, this.maxMarks, this.pivot});

  factory ExamSubject.fromJson(Map<String, dynamic> json) => ExamSubject(
    id: json['id'],
    name: json['name'] ?? '',
    maxMarks: json['pivot']?['max_marks'] != null
        ? double.tryParse(json['pivot']['max_marks'].toString())
        : null,
    pivot: json['pivot']?.toString(),
  );

  Map<String, dynamic> toJson() => {
    'subject_id': id,
    'max_marks': maxMarks,
  };
}

class TermBrief {
  final int id;
  final String name;
  TermBrief({required this.id, required this.name});
  factory TermBrief.fromJson(Map<String, dynamic> json) =>
    TermBrief(id: json['id'], name: json['name'] ?? '');
}
