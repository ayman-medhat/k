class Student {
  final int id;
  final int contactId;
  final int? gradeId;
  final int? sectionId;
  final int? secondLanguageId;
  final String? governmentCode;
  final String? seatNo;
  final String? secretCode;
  final int? fatherId;
  final int? motherId;
  final String? guardian;
  final String? photo;
  final int? ageAtOctober;
  final String? createdAt;
  final ContactBrief? contact;
  final GradeBrief? grade;
  final SectionBrief? section;

  Student({
    required this.id,
    required this.contactId,
    this.gradeId,
    this.sectionId,
    this.secondLanguageId,
    this.governmentCode,
    this.seatNo,
    this.secretCode,
    this.fatherId,
    this.motherId,
    this.guardian,
    this.photo,
    this.ageAtOctober,
    this.createdAt,
    this.contact,
    this.grade,
    this.section,
  });

  factory Student.fromJson(Map<String, dynamic> json) => Student(
    id: json['id'],
    contactId: json['contact_id'],
    gradeId: json['grade_id'],
    sectionId: json['section_id'],
    secondLanguageId: json['second_language_id'],
    governmentCode: json['government_code'],
    seatNo: json['seat_no'],
    secretCode: json['secret_code'],
    fatherId: json['father_id'],
    motherId: json['mother_id'],
    guardian: json['guardian'],
    photo: json['photo'],
    ageAtOctober: json['age_at_october'],
    createdAt: json['created_at'],
    contact: json['contact'] != null ? ContactBrief.fromJson(json['contact']) : null,
    grade: json['grade'] != null ? GradeBrief.fromJson(json['grade']) : null,
    section: json['section'] != null ? SectionBrief.fromJson(json['section']) : null,
  );

  Map<String, dynamic> toJson() => {
    'contact_id': contactId,
    'grade_id': gradeId,
    'section_id': sectionId,
    'second_language_id': secondLanguageId,
    'government_code': governmentCode,
    'seat_no': seatNo,
    'secret_code': secretCode,
    'father_id': fatherId,
    'mother_id': motherId,
    'guardian': guardian,
    'photo': photo,
    'age_at_october': ageAtOctober,
  };
}

class ContactBrief {
  final int id;
  final String nameEn;
  final String nameAr;

  ContactBrief({required this.id, required this.nameEn, required this.nameAr});

  factory ContactBrief.fromJson(Map<String, dynamic> json) => ContactBrief(
    id: json['id'],
    nameEn: json['nameEn'] ?? '',
    nameAr: json['nameAr'] ?? '',
  );
}

class GradeBrief {
  final int id;
  final String name;
  final String? nameAr;

  GradeBrief({required this.id, required this.name, this.nameAr});

  factory GradeBrief.fromJson(Map<String, dynamic> json) => GradeBrief(
    id: json['id'],
    name: json['name'] ?? '',
    nameAr: json['name_ar'],
  );
}

class SectionBrief {
  final int id;
  final String name;
  final String? nameAr;

  SectionBrief({required this.id, required this.name, this.nameAr});

  factory SectionBrief.fromJson(Map<String, dynamic> json) => SectionBrief(
    id: json['id'],
    name: json['name'] ?? '',
    nameAr: json['name_ar'],
  );
}
