class Stage {
  final int id;
  final String name;
  final String nameAr;
  final int? levelOrder;
  final String? description;
  final List<dynamic>? grades;

  Stage({
    required this.id,
    required this.name,
    required this.nameAr,
    this.levelOrder,
    this.description,
    this.grades,
  });

  factory Stage.fromJson(Map<String, dynamic> json) => Stage(
    id: json['id'],
    name: json['name'] ?? '',
    nameAr: json['name_ar'] ?? '',
    levelOrder: json['level_order'],
    description: json['description'],
    grades: json['grades'],
  );

  Map<String, dynamic> toJson() => {
    'name': name,
    'name_ar': nameAr,
    'level_order': levelOrder,
    'description': description,
  };
}
