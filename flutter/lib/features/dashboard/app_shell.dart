import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../../providers/providers.dart';
import '../../models/user.dart';

class AppShell extends ConsumerStatefulWidget {
  final Widget child;

  const AppShell({super.key, required this.child});

  @override
  ConsumerState<AppShell> createState() => _AppShellState();
}

class _AppShellState extends ConsumerState<AppShell> {
  final GlobalKey<ScaffoldState> _scaffoldKey = GlobalKey<ScaffoldState>();

  @override
  Widget build(BuildContext context) {
    final authState = ref.watch(authStateProvider);

    return authState.when(
      loading: () => const Scaffold(body: Center(child: CircularProgressIndicator())),
      error: (e, _) => Scaffold(body: Center(child: Text('Error: $e'))),
      data: (user) {
        if (user == null) {
          WidgetsBinding.instance.addPostFrameCallback((_) => context.go('/login'));
          return const SizedBox.shrink();
        }
        return LayoutBuilder(
          builder: (context, constraints) {
            final isWide = constraints.maxWidth >= 900;
            if (isWide) {
              return _buildDesktopLayout(user);
            }
            return _buildMobileLayout(user);
          },
        );
      },
    );
  }

  Widget _buildDesktopLayout(User user) {
    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        title: const Text('Kashmos School'),
        actions: [
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 16),
            child: Row(
              mainAxisSize: MainAxisSize.min,
              children: [
                Icon(Icons.person, size: 20, color: Theme.of(context).colorScheme.onSurfaceVariant),
                const SizedBox(width: 8),
                Text(user.name, style: Theme.of(context).textTheme.bodyMedium),
              ],
            ),
          ),
        ],
      ),
      body: Row(
        children: [
          _Sidebar(user: user),
          const VerticalDivider(width: 1),
          Expanded(child: widget.child),
        ],
      ),
      bottomNavigationBar: BottomAppBar(
        child: SizedBox(
          height: 40,
          child: Center(
            child: Text(
              'Kashmos International School \u00a9 ${DateTime.now().year}',
              style: Theme.of(context).textTheme.bodySmall?.copyWith(color: Theme.of(context).colorScheme.onSurfaceVariant),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildMobileLayout(User user) {
    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        title: const Text('Kashmos School'),
        leading: IconButton(
          icon: const Icon(Icons.menu),
          onPressed: () => _scaffoldKey.currentState?.openDrawer(),
        ),
      ),
      drawer: Drawer(
        child: _DrawerContent(user: user),
      ),
      body: Column(
        children: [
          Expanded(child: widget.child),
          Container(
            height: 40,
            decoration: BoxDecoration(
              border: Border(top: BorderSide(color: Theme.of(context).dividerColor)),
            ),
            child: Center(
              child: Text(
                'Kashmos International School \u00a9 ${DateTime.now().year}',
                style: Theme.of(context).textTheme.bodySmall?.copyWith(color: Theme.of(context).colorScheme.onSurfaceVariant),
              ),
            ),
          ),
        ],
      ),
    );
  }
}

class _Sidebar extends ConsumerStatefulWidget {
  final User user;

  const _Sidebar({required this.user});

  @override
  ConsumerState<_Sidebar> createState() => _SidebarState();
}

class _SidebarState extends ConsumerState<_Sidebar> {
  String? _selectedRoute;

  @override
  void initState() {
    super.initState();
    final route = GoRouterState.of(context).matchedLocation;
    _selectedRoute = route;
  }

  @override
  Widget build(BuildContext context) {
    final items = _getNavItems(context, widget.user);
    final theme = Theme.of(context);

    return Container(
      width: 240,
      decoration: BoxDecoration(
        color: theme.colorScheme.surfaceContainerLow,
        border: Border(right: BorderSide(color: theme.dividerColor)),
      ),
      child: Column(
        children: [
          Expanded(
            child: ListView(
              padding: EdgeInsets.zero,
              children: [
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 16),
                  decoration: BoxDecoration(
                    border: Border(bottom: BorderSide(color: theme.dividerColor)),
                  ),
                  child: Row(
                    children: [
                      CircleAvatar(
                        radius: 18,
                        backgroundColor: theme.colorScheme.primaryContainer,
                        child: Text(
                          widget.user.name.isNotEmpty ? widget.user.name[0].toUpperCase() : '?',
                          style: TextStyle(
                            color: theme.colorScheme.onPrimaryContainer,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                      const SizedBox(width: 12),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(widget.user.name, style: theme.textTheme.bodyMedium?.copyWith(fontWeight: FontWeight.w600)),
                            Text(widget.user.email, style: theme.textTheme.bodySmall?.copyWith(color: theme.colorScheme.onSurfaceVariant)),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
                ...items.map((item) {
                  final selected = _selectedRoute == item.route;
                  return ListTile(
                    leading: Icon(
                      item.icon,
                      color: selected ? theme.colorScheme.primary : null,
                    ),
                    title: Text(
                      item.title,
                      style: TextStyle(
                        fontWeight: selected ? FontWeight.w600 : null,
                        color: selected ? theme.colorScheme.primary : null,
                      ),
                    ),
                    selected: selected,
                    selectedTileColor: theme.colorScheme.primaryContainer.withValues(alpha: 0.3),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                    onTap: () {
                      if (item.route != null) {
                        setState(() => _selectedRoute = item.route);
                        context.go(item.route!);
                      }
                    },
                  );
                }),
              ],
            ),
          ),
          const Divider(height: 1),
          ListTile(
            leading: const Icon(Icons.logout),
            title: const Text('Logout'),
            onTap: () async {
              await ref.read(authStateProvider.notifier).logout();
              context.go('/login');
            },
          ),
        ],
      ),
    );
  }
}

class _DrawerContent extends ConsumerWidget {
  final User user;

  const _DrawerContent({required this.user});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final items = _getNavItems(context, user);
    return ListView(
      padding: EdgeInsets.zero,
      children: [
        DrawerHeader(
          decoration: BoxDecoration(color: Theme.of(context).colorScheme.primaryContainer),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              Text('Kashmos School', style: Theme.of(context).textTheme.titleLarge),
              const SizedBox(height: 4),
              Text(user.name),
              Text(user.email, style: Theme.of(context).textTheme.bodySmall),
            ],
          ),
        ),
        ...items.map((item) => ListTile(
          leading: Icon(item.icon),
          title: Text(item.title),
          onTap: () {
            if (item.route != null) {
              context.go(item.route!);
              Navigator.of(context).pop();
            }
          },
        )),
        const Divider(),
        ListTile(
          leading: const Icon(Icons.logout),
          title: const Text('Logout'),
          onTap: () async {
            await ref.read(authStateProvider.notifier).logout();
            context.go('/login');
          },
        ),
      ],
    );
  }
}

List<_NavItem> _getNavItems(BuildContext context, User user) {
  return [
    _NavItem('Dashboard', Icons.dashboard, '/dashboard', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic || user.isHr)
      _NavItem('Leads', Icons.people_outline, '/leads', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic || user.isHr)
      _NavItem('Contacts', Icons.contacts, '/contacts', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic || user.isHr)
      _NavItem('Students', Icons.school, '/students', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic)
      _NavItem('Grades', Icons.grade, '/grades', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic)
      _NavItem('Subjects', Icons.book, '/subjects', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic)
      _NavItem('Sections', Icons.grid_view, '/sections', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic)
      _NavItem('Stages', Icons.layers, '/stages', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic)
      _NavItem('Grade-Subjects', Icons.link, '/grade-subjects', true),
    if (user.isAdmin || user.isAcademic)
      _NavItem('Academic Years', Icons.calendar_month, '/academic-years', true),
    if (user.isAdmin || user.isAcademic)
      _NavItem('Terms', Icons.date_range, '/terms', true),
    if (user.isAdmin || user.isStudentAffairs || user.isAcademic)
      _NavItem('Enrollments', Icons.app_registration, '/enrollments', true),
    if (user.isAdmin || user.isAcademic)
      _NavItem('Attendance', Icons.checklist, '/attendance', true),
    if (user.isAdmin || user.isAcademic)
      _NavItem('Exams', Icons.quiz, '/exams', true),
    if (user.isAdmin)
      _NavItem('School', Icons.business, '/school', true),
    if (user.isAdmin)
      _NavItem('Users', Icons.manage_accounts, '/users', true),
  ].where((item) => item.visible).toList();
}

class _NavItem {
  final String title;
  final IconData icon;
  final String? route;
  final bool visible;

  _NavItem(this.title, this.icon, this.route, this.visible);
}
