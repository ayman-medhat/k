import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../../providers/providers.dart';

class ContactsListScreen extends ConsumerStatefulWidget {
  const ContactsListScreen({super.key});

  @override
  ConsumerState<ContactsListScreen> createState() => _ContactsListScreenState();
}

class _ContactsListScreenState extends ConsumerState<ContactsListScreen> {
  String? _category;
  String _search = '';
  int _page = 1;

  @override
  Widget build(BuildContext context) {
    final contactsAsync = ref.watch(contactsProvider((category: _category, search: _search.isEmpty ? null : _search, page: _page)));

    return Scaffold(
      appBar: AppBar(
        title: const Text('Contacts'),
        actions: [
          IconButton(
            icon: const Icon(Icons.add),
            onPressed: () => context.go('/contacts/create'),
          ),
        ],
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(8),
            child: TextField(
              decoration: const InputDecoration(
                hintText: 'Search contacts...',
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
            child: contactsAsync.when(
              loading: () => const Center(child: CircularProgressIndicator()),
              error: (e, _) => Center(child: Text('Error: $e')),
              data: (result) {
                final contacts = result.data;
                if (contacts.isEmpty) return const Center(child: Text('No contacts found'));
                return RefreshIndicator(
                  onRefresh: () async => ref.invalidate(contactsProvider),
                  child: ListView.builder(
                    itemCount: contacts.length,
                    itemBuilder: (context, index) {
                      final contact = contacts[index];
                      return Card(
                        margin: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                        child: ListTile(
                          leading: CircleAvatar(child: Text(contact.nameEn[0].toUpperCase())),
                          title: Text(contact.nameEn),
                          subtitle: Text('${contact.status} - ${contact.categories.join(", ")}'),
                          onTap: () => context.go('/contacts/${contact.id}/edit'),
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
