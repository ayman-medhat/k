class Subject {
  final int id;
  final String name;
  final String nameAr;
  final String? description;
  final int? parentId;
  final bool isMain;
  final bool isReligionBased;
  final String? religion;
  final List<Subject>? children;

  Subject({
    required this.id,
    required this.name,
    required this.nameAr,
    this.description,
    this.parentId,
    this.isMain = true,
    this.isReligionBased = false,
    this.religion,
    this.children,
  });

  factory Subject.fromJson(Map<String, dynamic> json) => Subject(
    id: json['id'],
    name: json['name'] ?? '',
    nameAr: json['name_ar'] ?? '',
    description: json['description'],
    parentId: json['parent_id'],
    isMain: json['is_main'] ?? true,
    isReligionBased: json['is_religion_based'] ?? false,
    religion: json['religion'],
    children: json['children'] != null
        ? (json['children'] as List).map((e) => Subject.fromJson(e)).toList()
        : null,
  );

  Map<String, dynamic> toJson() => {
    'name': name,
    'name_ar': nameAr,
    'description': description,
    'parent_id': parentId,
    'is_main': isMain,
    'is_religion_based': isReligionBased,
    'religion': religion,
  };
}
