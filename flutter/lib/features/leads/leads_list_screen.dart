import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../../providers/providers.dart';
import '../../models/lead.dart';

class LeadsListScreen extends ConsumerStatefulWidget {
  const LeadsListScreen({super.key});

  @override
  ConsumerState<LeadsListScreen> createState() => _LeadsListScreenState();
}

class _LeadsListScreenState extends ConsumerState<LeadsListScreen> {
  String? _category;
  String _search = '';
  int _page = 1;

  @override
  Widget build(BuildContext context) {
    final leadsAsync = ref.watch(leadsProvider((category: _category, search: _search.isEmpty ? null : _search, page: _page)));

    return Scaffold(
      appBar: AppBar(
        title: const Text('Leads'),
        actions: [
          IconButton(
            icon: const Icon(Icons.add),
            onPressed: () => context.go('/leads/create'),
          ),
        ],
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(8),
            child: TextField(
              decoration: const InputDecoration(
                hintText: 'Search leads...',
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
            child: leadsAsync.when(
              loading: () => const Center(child: CircularProgressIndicator()),
              error: (e, _) => Center(child: Text('Error: $e')),
              data: (result) {
                final leads = result.data;
                if (leads.isEmpty) return const Center(child: Text('No leads found'));
                return RefreshIndicator(
                  onRefresh: () async => ref.invalidate(leadsProvider),
                  child: ListView.builder(
                    itemCount: leads.length,
                    itemBuilder: (context, index) {
                      final lead = leads[index];
                      return Card(
                        margin: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                        child: ListTile(
                          leading: CircleAvatar(
                            child: Text(lead.nameEn[0].toUpperCase()),
                          ),
                          title: Text(lead.nameEn),
                          subtitle: Text('${lead.status} - ${lead.categories.join(", ")}'),
                          trailing: Text(lead.createdAt?.substring(0, 10) ?? ''),
                          onTap: () => context.go('/leads/${lead.id}/edit'),
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
