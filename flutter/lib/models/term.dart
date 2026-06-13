class Term {
  final int id;
  final int academicYearId;
  final String name;
  final String? startDate;
  final String? endDate;
  final bool isCurrent;

  Term({
    required this.id,
    required this.academicYearId,
    required this.name,
    this.startDate,
    this.endDate,
    this.isCurrent = false,
  });

  factory Term.fromJson(Map<String, dynamic> json) => Term(
    id: json['id'],
    academicYearId: json['academic_year_id'],
    name: json['name'] ?? '',
    startDate: json['start_date'],
    endDate: json['end_date'],
    isCurrent: json['is_current'] ?? false,
  );

  Map<String, dynamic> toJson() => {
    'academic_year_id': academicYearId,
    'name': name,
    'start_date': startDate,
    'end_date': endDate,
    'is_current': isCurrent,
  };
}
