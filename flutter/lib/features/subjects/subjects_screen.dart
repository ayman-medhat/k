import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../providers/providers.dart';

class SubjectsScreen extends ConsumerWidget {
  const SubjectsScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final subjectsAsync = ref.watch(subjectsProvider);

    return Scaffold(
      appBar: AppBar(title: const Text('Subjects')),
      body: subjectsAsync.when(
        loading: () => const Center(child: CircularProgressIndicator()),
        error: (e, _) => Center(child: Text('Error: $e')),
        data: (subjects) {
          if (subjects.isEmpty) return const Center(child: Text('No subjects found'));
          return RefreshIndicator(
            onRefresh: () async => ref.invalidate(subjectsProvider),
            child: ListView.builder(
              itemCount: subjects.length,
              itemBuilder: (context, index) {
                final subject = subjects[index];
                return ExpansionTile(
                  title: Text('${subject.name} (${subject.nameAr})'),
                  subtitle: Text(subject.isReligionBased ? 'Religion-based' : subject.isMain ? 'Main' : 'Optional'),
                  children: subject.children?.map((child) =>
                    ListTile(
                      title: Text(child.name),
                      subtitle: Text(child.nameAr),
                      dense: true,
                    )
                  ).toList() ?? [],
                );
              },
            ),
          );
        },
      ),
    );
  }
}
