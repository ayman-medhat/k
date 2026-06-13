class Section {
  final int id;
  final int gradeId;
  final String name;
  final String nameAr;

  Section({
    required this.id,
    required this.gradeId,
    required this.name,
    required this.nameAr,
  });

  factory Section.fromJson(Map<String, dynamic> json) => Section(
    id: json['id'],
    gradeId: json['grade_id'],
    name: json['name'] ?? '',
    nameAr: json['name_ar'] ?? '',
  );

  Map<String, dynamic> toJson() => {
    'grade_id': gradeId,
    'name': name,
    'name_ar': nameAr,
  };
}
