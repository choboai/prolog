@php
    $description = "Prolog programs manager";
    if (request()->is('programs')){
        $programCount = \App\Models\Program::count();
        $description = "Write, execute, visualise and share your Prolog programs\n\n🔥 {$programCount} programs and counting!";
    } else if (request()->is('programs/*')){
        $programName = request()->program->name ?? 'Nameless program';
        $programAuthor = request()->program->user->name ?? 'Guest user';
        $description = "✨ Program name:\n{$programName}\n\n👨‍💻 Author:\n{$programAuthor}";
    }
@endphp
<x-social-meta
    title="Prolog"
    card="summary"
    :description="$description"
    :image="asset('storage/logo.jpg')"
/>
<meta name="theme-color" content="#9f580a">
