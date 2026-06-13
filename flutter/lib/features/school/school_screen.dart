import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';

class SchoolScreen extends ConsumerStatefulWidget {
  const SchoolScreen({super.key});

  @override
  ConsumerState<SchoolScreen> createState() => _SchoolScreenState();
}

class _SchoolScreenState extends ConsumerState<SchoolScreen> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('School Profile')),
      body: const Center(child: Text('School profile - coming soon')),
    );
  }
}
