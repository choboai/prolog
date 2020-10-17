@php
    $description = "Prolog programs manager";
    if (request()->is('programs')){
        $programCount = \App\Models\Program::count();
        $description = "Prolog programs manager\n\n👨‍💻 {$programCount} programs and counting!";
    } else if (request()->is('programs/*')){
        $programName = request()->program->name;
        $description = "Program name:\n\n{$programName}" ?? 'Nameless program';
    }
@endphp
<x-social-meta
    title="Prolog"
    card="summary"
    :description="$description"
    :image="asset('storage/logo.jpg')"
/>
<meta name="theme-color" content="#9f580a">
