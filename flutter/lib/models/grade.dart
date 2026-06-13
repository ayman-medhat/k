class Grade {
  final int id;
  final String name;
  final String nameAr;
  final int? levelOrder;
  final String? description;

  Grade({
    required this.id,
    required this.name,
    required this.nameAr,
    this.levelOrder,
    this.description,
  });

  factory Grade.fromJson(Map<String, dynamic> json) => Grade(
    id: json['id'],
    name: json['name'] ?? '',
    nameAr: json['name_ar'] ?? '',
    levelOrder: json['level_order'],
    description: json['description'],
  );

  Map<String, dynamic> toJson() => {
    'name': name,
    'name_ar': nameAr,
    'level_order': levelOrder,
    'description': description,
  };
}
