class Lead {
  final int id;
  final String nameEn;
  final String nameAr;
  final String? email;
  final String? phone;
  final String? nationality;
  final String? religion;
  final String? gender;
  final String? nationalId;
  final String? passportNo;
  final String? birthDate;
  final String status;
  final List<String> categories;
  final int? parentId;
  final int? motherId;
  final int? gradeId;
  final int? secondLanguageSubjectId;
  final String? source;
  final String? notes;
  final String? createdAt;
  final Lead? parent;
  final Lead? mother;

  Lead({
    required this.id,
    required this.nameEn,
    required this.nameAr,
    this.email,
    this.phone,
    this.nationality,
    this.religion,
    this.gender,
    this.nationalId,
    this.passportNo,
    this.birthDate,
    this.status = 'New',
    this.categories = const ['Parent'],
    this.parentId,
    this.motherId,
    this.gradeId,
    this.secondLanguageSubjectId,
    this.source,
    this.notes,
    this.createdAt,
    this.parent,
    this.mother,
  });

  factory Lead.fromJson(Map<String, dynamic> json) => Lead(
    id: json['id'],
    nameEn: json['nameEn'] ?? '',
    nameAr: json['nameAr'] ?? '',
    email: json['email'],
    phone: json['phone'],
    nationality: json['nationality'],
    religion: json['religion'],
    gender: json['gender'],
    nationalId: json['national_id'],
    passportNo: json['passport_no'],
    birthDate: json['birth_date'],
    status: json['status'] ?? 'New',
    categories: json['categories'] != null
        ? List<String>.from(json['categories'])
        : ['Parent'],
    parentId: json['parent_id'],
    motherId: json['mother_id'],
    gradeId: json['grade_id'],
    secondLanguageSubjectId: json['second_language_subject_id'],
    source: json['source'],
    notes: json['notes'],
    createdAt: json['created_at'],
    parent: json['parent'] != null ? Lead.fromJson(json['parent']) : null,
    mother: json['mother'] != null ? Lead.fromJson(json['mother']) : null,
  );

  Map<String, dynamic> toJson() => {
    'nameEn': nameEn,
    'nameAr': nameAr,
    'email': email,
    'phone': phone,
    'nationality': nationality,
    'religion': religion,
    'gender': gender,
    'national_id': nationalId,
    'passport_no': passportNo,
    'birth_date': birthDate,
    'status': status,
    'categories': categories,
    'parent_id': parentId,
    'mother_id': motherId,
    'grade_id': gradeId,
    'second_language_subject_id': secondLanguageSubjectId,
    'source': source,
    'notes': notes,
  };
}
