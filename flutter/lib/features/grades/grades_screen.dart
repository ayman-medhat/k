import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../providers/providers.dart';

class GradesScreen extends ConsumerWidget {
  const GradesScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final gradesAsync = ref.watch(gradesProvider);

    return Scaffold(
      appBar: AppBar(title: const Text('Grades')),
      body: gradesAsync.when(
        loading: () => const Center(child: CircularProgressIndicator()),
        error: (e, _) => Center(child: Text('Error: $e')),
        data: (grades) {
          if (grades.isEmpty) return const Center(child: Text('No grades found'));
          return RefreshIndicator(
            onRefresh: () async => ref.invalidate(gradesProvider),
            child: ListView.builder(
              itemCount: grades.length,
              itemBuilder: (context, index) {
                final grade = grades[index];
                return ListTile(
                  title: Text(grade.name),
                  subtitle: Text(grade.nameAr),
                  trailing: Text('Level ${grade.levelOrder ?? "N/A"}'),
                );
              },
            ),
          );
        },
      ),
    );
  }
}
