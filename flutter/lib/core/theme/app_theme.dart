import 'package:flutter/material.dart';
import 'package:flex_color_scheme/flex_color_scheme.dart';

class AppTheme {
  static ThemeData get light => FlexThemeData.light(
    scheme: FlexScheme.indigo,
    surfaceMode: FlexSurfaceMode.level,
    blendLevel: 20,
    appBarStyle: FlexAppBarStyle.background,
    bottomAppBarElevation: 2,
    lightIsWhite: false,
    useMaterial3: true,
    swapLegacyOnMaterial3: true,
  );

  static ThemeData get dark => FlexThemeData.dark(
    scheme: FlexScheme.indigo,
    surfaceMode: FlexSurfaceMode.level,
    blendLevel: 15,
    appBarStyle: FlexAppBarStyle.background,
    bottomAppBarElevation: 2,
    useMaterial3: true,
    swapLegacyOnMaterial3: true,
  );

  static ThemeData get natural => FlexThemeData.light(
    scheme: FlexScheme.green,
    surfaceMode: FlexSurfaceMode.level,
    blendLevel: 20,
    appBarStyle: FlexAppBarStyle.background,
    useMaterial3: true,
    swapLegacyOnMaterial3: true,
  );
}
