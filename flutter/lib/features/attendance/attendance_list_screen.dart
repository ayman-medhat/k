import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../../providers/providers.dart';

class AttendanceListScreen extends ConsumerStatefulWidget {
  const AttendanceListScreen({super.key});

  @override
  ConsumerState<AttendanceListScreen> createState() => _AttendanceListScreenState();
}

class _AttendanceListScreenState extends ConsumerState<AttendanceListScreen> {
  int? _gradeId;
  int? _sectionId;
  String? _statusFilter;
  String? _dateFrom;
  String? _dateTo;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Attendance'),
        actions: [
          IconButton(
            icon: const Icon(Icons.edit_calendar),
            onPressed: () => context.go('/attendance/take'),
            tooltip: 'Take Attendance',
          ),
        ],
      ),
      body: const Center(
        child: Text('Attendance records list - filtered by grade/section/date'),
      ),
    );
  }
}

class TakeAttendanceScreen extends ConsumerStatefulWidget {
  const TakeAttendanceScreen({super.key});

  @override
  ConsumerState<TakeAttendanceScreen> createState() => _TakeAttendanceScreenState();
}

class _TakeAttendanceScreenState extends ConsumerState<TakeAttendanceScreen> {
  int? _gradeId;
  int? _sectionId;
  String _date = '';
  List<Map<String, dynamic>> _records = [];
  bool _isLoading = false;

  @override
  void initState() {
    super.initState();
    _date = DateTime.now().toIso8601String().substring(0, 10);
  }

  Future<void> _loadStudents() async {
    if (_sectionId == null) return;
    setState(() => _isLoading = true);
    try {
      final records = await ref.read(apiServiceProvider).getAttendanceStudents(_sectionId!, _date);
      setState(() => _records = records);
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Error: $e')));
      }
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  Future<void> _save() async {
    if (_sectionId == null) return;
    setState(() => _isLoading = true);
    try {
      final records = _records.map((r) => {
        'student_id': r['student_id'],
        'status': r['status'],
        'notes': r['notes'],
      }).toList();

      await ref.read(apiServiceProvider).takeAttendance(_sectionId!, _date, records);
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Attendance saved')),
        );
        context.go('/attendance');
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
      appBar: AppBar(title: const Text('Take Attendance')),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            DropdownButtonFormField<int?>(
              value: _gradeId,
              decoration: const InputDecoration(labelText: 'Grade', border: OutlineInputBorder()),
              items: [],
              onChanged: (v) async {
                setState(() {
                  _gradeId = v;
                  _sectionId = null;
                });
              },
            ),
            const SizedBox(height: 12),
            TextFormField(
              decoration: const InputDecoration(labelText: 'Date', border: OutlineInputBorder()),
              readOnly: true,
              controller: TextEditingController(text: _date),
              onTap: () async {
                final picked = await showDatePicker(
                  context: context,
                  initialDate: DateTime.parse(_date),
                  firstDate: DateTime(2020),
                  lastDate: DateTime(2030),
                );
                if (picked != null) {
                  setState(() => _date = picked.toIso8601String().substring(0, 10));
                }
              },
            ),
            const SizedBox(height: 12),
            FilledButton(onPressed: _loadStudents, child: const Text('Load Students')),
            const SizedBox(height: 16),
            if (_isLoading)
              const Center(child: CircularProgressIndicator())
            else
              ...List.generate(_records.length, (i) {
                final record = _records[i];
                return Card(
                  margin: const EdgeInsets.symmetric(vertical: 4),
                  child: ListTile(
                    title: Text(record['student_name'] ?? 'Unknown'),
                    subtitle: DropdownButton<String>(
                      value: record['status'],
                      items: const [
                        DropdownMenuItem(value: 'present', child: Text('Present')),
                        DropdownMenuItem(value: 'absent', child: Text('Absent')),
                        DropdownMenuItem(value: 'late', child: Text('Late')),
                        DropdownMenuItem(value: 'excused', child: Text('Excused')),
                      ],
                      onChanged: (v) {
                        setState(() => _records[i]['status'] = v);
                      },
                    ),
                  ),
                );
              }),
            if (_records.isNotEmpty) ...[
              const SizedBox(height: 16),
              FilledButton(
                onPressed: _save,
                style: FilledButton.styleFrom(padding: const EdgeInsets.symmetric(vertical: 16)),
                child: const Text('Save Attendance'),
              ),
            ],
          ],
        ),
      ),
    );
  }
}
