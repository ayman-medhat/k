import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';

class EnrollmentsListScreen extends ConsumerStatefulWidget {
  const EnrollmentsListScreen({super.key});

  @override
  ConsumerState<EnrollmentsListScreen> createState() => _EnrollmentsListScreenState();
}

class _EnrollmentsListScreenState extends ConsumerState<EnrollmentsListScreen> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Enrollments'),
        actions: [
          IconButton(
            icon: const Icon(Icons.add),
            onPressed: () => context.go('/enrollments/create'),
          ),
        ],
      ),
      body: const Center(child: Text('Enrollments list - coming soon')),
    );
  }
}
