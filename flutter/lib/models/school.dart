class School {
  final int id;
  final String? nameEn;
  final String? nameAr;
  final String? address;
  final String? phone;
  final String? email;
  final String? website;
  final String? logo;
  final String? principalName;
  final String? mission;
  final String? vision;
  final String? socialFacebook;
  final String? socialTwitter;
  final String? socialInstagram;
  final String? socialLinkedin;
  final int? establishedYear;

  School({
    required this.id,
    this.nameEn,
    this.nameAr,
    this.address,
    this.phone,
    this.email,
    this.website,
    this.logo,
    this.principalName,
    this.mission,
    this.vision,
    this.socialFacebook,
    this.socialTwitter,
    this.socialInstagram,
    this.socialLinkedin,
    this.establishedYear,
  });

  factory School.fromJson(Map<String, dynamic> json) => School(
    id: json['id'],
    nameEn: json['nameEn'],
    nameAr: json['nameAr'],
    address: json['address'],
    phone: json['phone'],
    email: json['email'],
    website: json['website'],
    logo: json['logo'],
    principalName: json['principal_name'],
    mission: json['mission'],
    vision: json['vision'],
    socialFacebook: json['social_facebook'],
    socialTwitter: json['social_twitter'],
    socialInstagram: json['social_instagram'],
    socialLinkedin: json['social_linkedin'],
    establishedYear: json['established_year'],
  );

  Map<String, dynamic> toJson() => {
    'nameEn': nameEn,
    'nameAr': nameAr,
    'address': address,
    'phone': phone,
    'email': email,
    'website': website,
    'logo': logo,
    'principal_name': principalName,
    'mission': mission,
    'vision': vision,
    'social_facebook': socialFacebook,
    'social_twitter': socialTwitter,
    'social_instagram': socialInstagram,
    'social_linkedin': socialLinkedin,
    'established_year': establishedYear,
  };
}
