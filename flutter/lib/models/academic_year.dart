class AcademicYear {
  final int id;
  final String name;
  final String? startDate;
  final String? endDate;
  final bool isCurrent;

  AcademicYear({
    required this.id,
    required this.name,
    this.startDate,
    this.endDate,
    this.isCurrent = false,
  });

  factory AcademicYear.fromJson(Map<String, dynamic> json) => AcademicYear(
    id: json['id'],
    name: json['name'] ?? '',
    startDate: json['start_date'],
    endDate: json['end_date'],
    isCurrent: json['is_current'] ?? false,
  );

  Map<String, dynamic> toJson() => {
    'name': name,
    'start_date': startDate,
    'end_date': endDate,
    'is_current': isCurrent,
  };
}
