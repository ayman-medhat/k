import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../../providers/providers.dart';

class StudentsListScreen extends ConsumerStatefulWidget {
  const StudentsListScreen({super.key});

  @override
  ConsumerState<StudentsListScreen> createState() => _StudentsListScreenState();
}

class _StudentsListScreenState extends ConsumerState<StudentsListScreen> {
  String _search = '';
  int _page = 1;

  Future<void> _deleteStudent(int id) async {
    try {
      await ref.read(apiServiceProvider).deleteStudent(id);
      ref.invalidate(leadsProvider);
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Student deleted')),
        );
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Error: $e')),
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final studentsAsync = ref.watch(studentsProvider((search: _search.isEmpty ? null : _search, page: _page)));

    return Scaffold(
      appBar: AppBar(
        title: const Text('Students'),
        actions: [
          IconButton(
            icon: const Icon(Icons.add),
            onPressed: () => context.go('/students/create'),
          ),
        ],
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(8),
            child: TextField(
              decoration: const InputDecoration(
                hintText: 'Search students...',
                prefixIcon: Icon(Icons.search),
                border: OutlineInputBorder(),
              ),
              onChanged: (v) => setState(() {
                _search = v;
                _page = 1;
              }),
            ),
          ),
          Expanded(
            child: studentsAsync.when(
              loading: () => const Center(child: CircularProgressIndicator()),
              error: (e, _) => Center(child: Text('Error: $e')),
              data: (result) {
                final students = result.data;
                if (students.isEmpty) return const Center(child: Text('No students found'));
                return RefreshIndicator(
                  onRefresh: () async => ref.invalidate(studentsProvider),
                  child: ListView.builder(
                    itemCount: students.length,
                    itemBuilder: (context, index) {
                      final student = students[index];
                      return Card(
                        margin: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                        child: ListTile(
                          leading: CircleAvatar(
                            child: Text(student.contact?.nameEn[0].toUpperCase() ?? '?'),
                          ),
                          title: Text(student.contact?.nameEn ?? 'Unknown'),
                          subtitle: Text('${student.grade?.name ?? "N/A"} - Seat: ${student.seatNo ?? "N/A"}'),
                          trailing: PopupMenuButton(
                            itemBuilder: (context) => [
                              const PopupMenuItem(value: 'edit', child: Text('Edit')),
                              const PopupMenuItem(value: 'delete', child: Text('Delete')),
                            ],
                            onSelected: (v) {
                              if (v == 'edit') context.go('/students/${student.id}/edit');
                              if (v == 'delete') _deleteStudent(student.id);
                            },
                          ),
                        ),
                      );
                    },
                  ),
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}
