import 'package:flutter/material.dart';

class CrudListScreen<T> extends StatelessWidget {
  final String title;
  final AsyncSnapshot<List<T>>? snapshot;
  final Widget Function(T item) itemBuilder;
  final VoidCallback? onCreate;
  final Widget? filters;
  final bool isLoading;
  final String? errorMessage;

  const CrudListScreen({
    super.key,
    required this.title,
    this.snapshot,
    required this.itemBuilder,
    this.onCreate,
    this.filters,
    this.isLoading = false,
    this.errorMessage,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(title),
        actions: [
          if (onCreate != null)
            IconButton(
              icon: const Icon(Icons.add),
              onPressed: onCreate,
            ),
        ],
      ),
      body: Column(
        children: [
          if (filters != null) Padding(padding: const EdgeInsets.all(8), child: filters!),
          Expanded(
            child: _buildBody(context),
          ),
        ],
      ),
    );
  }

  Widget _buildBody(BuildContext context) {
    if (isLoading) {
      return const Center(child: CircularProgressIndicator());
    }
    if (errorMessage != null) {
      return Center(child: Text('Error: $errorMessage'));
    }
    if (snapshot == null || snapshot!.data == null || snapshot!.data!.isEmpty) {
      return const Center(child: Text('No data found'));
    }
    return ListView.builder(
      padding: const EdgeInsets.all(8),
      itemCount: snapshot!.data!.length,
      itemBuilder: (context, index) => itemBuilder(snapshot!.data![index]),
    );
  }
}
