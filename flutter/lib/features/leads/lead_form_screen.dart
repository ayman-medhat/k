import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../../providers/providers.dart';
import '../../models/lead.dart';

class LeadFormScreen extends ConsumerStatefulWidget {
  final int? leadId;
  const LeadFormScreen({super.key, this.leadId});

  @override
  ConsumerState<LeadFormScreen> createState() => _LeadFormScreenState();
}

class _LeadFormScreenState extends ConsumerState<LeadFormScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nameEnController = TextEditingController();
  final _nameArController = TextEditingController();
  final _emailController = TextEditingController();
  final _phoneController = TextEditingController();
  final _nationalIdController = TextEditingController();

  String _nationality = 'Egyptian';
  String? _religion;
  String? _gender;
  String _status = 'New';
  List<String> _categories = ['Parent'];
  bool _isLoading = false;

  @override
  void initState() {
    super.initState();
    if (widget.leadId != null) {
      _loadLead();
    }
  }

  Future<void> _loadLead() async {
    try {
      final lead = await ref.read(apiServiceProvider).getLead(widget.leadId!);
      _nameEnController.text = lead.nameEn;
      _nameArController.text = lead.nameAr;
      _emailController.text = lead.email ?? '';
      _phoneController.text = lead.phone ?? '';
      _nationalIdController.text = lead.nationalId ?? '';
      _nationality = lead.nationality ?? 'Egyptian';
      _religion = lead.religion;
      _gender = lead.gender;
      _status = lead.status;
      _categories = lead.categories;
    } catch (_) {}
  }

  @override
  void dispose() {
    _nameEnController.dispose();
    _nameArController.dispose();
    _emailController.dispose();
    _phoneController.dispose();
    _nationalIdController.dispose();
    super.dispose();
  }

  Future<void> _save() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => _isLoading = true);

    try {
      final data = {
        'nameEn': _nameEnController.text.trim(),
        'nameAr': _nameArController.text.trim(),
        'email': _emailController.text.trim().isEmpty ? null : _emailController.text.trim(),
        'phone': _phoneController.text.trim().isEmpty ? null : _phoneController.text.trim(),
        'nationality': _nationality,
        'religion': _religion,
        'gender': _gender,
        'status': _status,
        'categories': _categories,
        'national_id': _nationality == 'Egyptian' ? _nationalIdController.text.trim() : null,
        'passport_no': _nationality != 'Egyptian' ? _nationalIdController.text.trim() : null,
      };

      if (widget.leadId != null) {
        await ref.read(apiServiceProvider).updateLead(widget.leadId!, data);
      } else {
        await ref.read(apiServiceProvider).createLead(data);
      }

      if (mounted) {
        ref.invalidate(leadsProvider);
        context.go('/leads');
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Error: $e')));
      }
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text(widget.leadId != null ? 'Edit Lead' : 'Create Lead')),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              TextFormField(
                controller: _nameEnController,
                decoration: const InputDecoration(labelText: 'Name (English)', border: OutlineInputBorder()),
                validator: (v) => v?.isEmpty ?? true ? 'Required' : null,
              ),
              const SizedBox(height: 12),
              TextFormField(
                controller: _nameArController,
                decoration: const InputDecoration(labelText: 'Name (Arabic)', border: OutlineInputBorder()),
                validator: (v) => v?.isEmpty ?? true ? 'Required' : null,
              ),
              const SizedBox(height: 12),
              TextFormField(
                controller: _emailController,
                decoration: const InputDecoration(labelText: 'Email', border: OutlineInputBorder()),
                keyboardType: TextInputType.emailAddress,
              ),
              const SizedBox(height: 12),
              TextFormField(
                controller: _phoneController,
                decoration: const InputDecoration(labelText: 'Phone', border: OutlineInputBorder()),
              ),
              const SizedBox(height: 12),
              DropdownButtonFormField<String>(
                value: _nationality,
                decoration: const InputDecoration(labelText: 'Nationality', border: OutlineInputBorder()),
                items: const [
                  DropdownMenuItem(value: 'Egyptian', child: Text('Egyptian')),
                  DropdownMenuItem(value: 'Other', child: Text('Other')),
                ],
                onChanged: (v) => setState(() => _nationality = v!),
              ),
              const SizedBox(height: 12),
              TextFormField(
                controller: _nationalIdController,
                decoration: InputDecoration(
                  labelText: _nationality == 'Egyptian' ? 'National ID' : 'Passport No',
                  border: const OutlineInputBorder(),
                ),
              ),
              const SizedBox(height: 12),
              DropdownButtonFormField<String?>(
                value: _religion,
                decoration: const InputDecoration(labelText: 'Religion', border: OutlineInputBorder()),
                items: const [
                  DropdownMenuItem(value: null, child: Text('Select')),
                  DropdownMenuItem(value: 'Muslim', child: Text('Muslim')),
                  DropdownMenuItem(value: 'Christian', child: Text('Christian')),
                ],
                onChanged: (v) => setState(() => _religion = v),
              ),
              const SizedBox(height: 12),
              DropdownButtonFormField<String?>(
                value: _gender,
                decoration: const InputDecoration(labelText: 'Gender', border: OutlineInputBorder()),
                items: const [
                  DropdownMenuItem(value: null, child: Text('Select')),
                  DropdownMenuItem(value: 'Male', child: Text('Male')),
                  DropdownMenuItem(value: 'Female', child: Text('Female')),
                ],
                onChanged: (v) => setState(() => _gender = v),
              ),
              const SizedBox(height: 12),
              Wrap(
                spacing: 8,
                children: ['Parent', 'Student', 'Employee', 'Supplier', 'Partner', 'Owner'].map((cat) {
                  final selected = _categories.contains(cat);
                  return FilterChip(
                    label: Text(cat),
                    selected: selected,
                    onSelected: (v) {
                      setState(() {
                        if (v) {
                          _categories = [cat];
                        } else {
                          _categories = ['Parent'];
                        }
                      });
                    },
                  );
                }).toList(),
              ),
              const SizedBox(height: 24),
              _isLoading
                  ? const Center(child: CircularProgressIndicator())
                  : FilledButton(
                      onPressed: _save,
                      style: FilledButton.styleFrom(padding: const EdgeInsets.symmetric(vertical: 16)),
                      child: const Text('Save', style: TextStyle(fontSize: 16)),
                    ),
            ],
          ),
        ),
      ),
    );
  }
}
