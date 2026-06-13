import 'student.dart';

class Contact {
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
  final String? source;
  final String? notes;
  final String? createdAt;
  final Contact? parent;
  final Contact? mother;
  final Student? student;

  Contact({
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
    this.status = 'Active',
    this.categories = const ['Parent'],
    this.parentId,
    this.motherId,
    this.source,
    this.notes,
    this.createdAt,
    this.parent,
    this.mother,
    this.student,
  });

  factory Contact.fromJson(Map<String, dynamic> json) => Contact(
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
    status: json['status'] ?? 'Active',
    categories: json['categories'] != null
        ? List<String>.from(json['categories'])
        : ['Parent'],
    parentId: json['parent_id'],
    motherId: json['mother_id'],
    source: json['source'],
    notes: json['notes'],
    createdAt: json['created_at'],
    parent: json['parent'] != null ? Contact.fromJson(json['parent']) : null,
    mother: json['mother'] != null ? Contact.fromJson(json['mother']) : null,
    student: json['student'] != null ? Student.fromJson(json['student']) : null,
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
    'source': source,
    'notes': notes,
  };
}
