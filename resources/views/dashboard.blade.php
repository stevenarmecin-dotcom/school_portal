<x-layout>
    <style>
        .dashboard h1,
        .dashboard h2,
        .dashboard h3 {
            color: #1565C0;
            text-align: left;
        }

        .dashboard h1 {
            margin-bottom: 6px;
        }

        .dashboard h2 {
            margin-bottom: 16px;
        }

        .dashboard p {
            color: #555;
            text-align: left;
            margin: 0;
        }

        .dashboard-header,
        .dashboard-section-header,
        .dashboard-stats,
        .dashboard-grid {
            display: flex;
            gap: 16px;
        }

        .dashboard-header,
        .dashboard-section-header {
            align-items: center;
            justify-content: space-between;
        }

        .dashboard-header {
            margin-bottom: 24px;
        }

        .dashboard-header form {
            flex-direction: row;
        }

        .dashboard-header button {
            padding: 10px 18px;
        }

        .dashboard-student-form {
            flex-direction: row;
            margin-bottom: 12px;
        }

        .dashboard-student-form input,
        .dashboard-course-form input,
        .dashboard-phone-form input {
            flex: 1;
            min-width: 0;
        }

        .dashboard-student-form button,
        .dashboard-course-form button,
        .dashboard-phone-form button {
            padding: 10px 18px;
        }

        .dashboard-form {
            margin-bottom: 12px;
        }

        .dashboard-form textarea,
        .dashboard-comment-form textarea {
            width: 100%;
            min-height: 88px;
            padding: 14px;
            border: 2px solid #BBDEFB;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            background: #F8FBFF;
            resize: vertical;
        }

        .dashboard-form textarea:focus,
        .dashboard-comment-form textarea:focus {
            border-color: #1565C0;
            box-shadow: 0 0 10px rgba(21, 101, 192, 0.2);
        }

        .dashboard-phone-form {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 12px;
            margin-bottom: 12px;
        }

        .dashboard-error {
            color: #D32F2F !important;
            margin-bottom: 12px !important;
        }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .dashboard-stats {
            margin-bottom: 28px;
        }

        .dashboard-stat,
        .dashboard-card {
            background: #F8FBFF;
            border: 1px solid #BBDEFB;
            border-radius: 12px;
            padding: 18px;
        }

        .dashboard-stat {
            flex: 1;
        }

        .dashboard-stat strong {
            display: block;
            color: #0D47A1;
            font-size: 24px;
        }

        .dashboard-grid {
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .dashboard-grid > .dashboard-section {
            flex: 1;
            min-width: 0;
        }

        .dashboard-section {
            margin-bottom: 24px;
        }

        .dashboard-section-header {
            margin-bottom: 12px;
        }

        .dashboard-list {
            display: grid;
            gap: 12px;
        }

        .dashboard-card h3 {
            margin-bottom: 6px;
        }

        .dashboard-meta {
            font-size: 13px;
            margin-bottom: 10px !important;
        }

        .dashboard-card .dashboard-body {
            line-height: 1.5;
            white-space: pre-line;
        }

        .dashboard-comments {
            border-top: 1px solid #BBDEFB;
            margin-top: 14px;
            padding-top: 12px;
        }

        .dashboard-comments ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .dashboard-comments li {
            color: #555;
            margin-top: 6px;
        }

        .dashboard-comment-form {
            flex-direction: row;
            align-items: flex-start;
            margin-top: 12px;
        }

        .dashboard-comment-form textarea {
            flex: 1;
            min-width: 0;
        }

        .dashboard-empty {
            color: #666;
            padding: 16px;
            text-align: center;
        }

        @media (max-width: 760px) {
            .dashboard-stats,
            .dashboard-grid {
                flex-direction: column;
            }

            .dashboard-stats > *,
            .dashboard-grid > * {
                width: 100%;
            }
        }
    </style>

    <div class="dashboard">
        <header class="dashboard-header">
            <div>
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <p>Your dashboard data</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </header>

        <section class="dashboard-stats" aria-label="Database summary">
            <div class="dashboard-stat">
                <strong>{{ $posts->count() }}</strong>
                <span>Posts</span>
            </div>
            <div class="dashboard-stat">
                <strong>{{ $posts->sum('comments_count') }}</strong>
                <span>Comments</span>
            </div>
            <div class="dashboard-stat">
                <strong>{{ $students->count() }}</strong>
                <span>Students</span>
            </div>
            <div class="dashboard-stat">
                <strong>{{ $courses->count() }}</strong>
                <span>Courses</span>
            </div>
            <div class="dashboard-stat">
                <strong>{{ $userPhones->sum(fn ($userPhone) => $userPhone->phones->count()) }}</strong>
                <span>Phone numbers</span>
            </div>
        </section>

        <section class="dashboard-section">
            <div class="dashboard-section-header">
                <h2>Posts and comments</h2>
            </div>
            <form class="dashboard-form" method="POST" action="{{ route('posts.store') }}">
                @csrf
                <label class="visually-hidden" for="post-title">Post title</label>
                <input
                    id="post-title"
                    type="text"
                    name="post_title"
                    value="{{ old('post_title') }}"
                    placeholder="Post title"
                    maxlength="255"
                    required
                >
                @error('post_title')
                    <p class="dashboard-error">{{ $message }}</p>
                @enderror
                <label class="visually-hidden" for="post-body">Post content</label>
                <textarea
                    id="post-body"
                    name="post_body"
                    placeholder="Write a post"
                    required
                >{{ old('post_body') }}</textarea>
                @error('post_body')
                    <p class="dashboard-error">{{ $message }}</p>
                @enderror
                <button type="submit">Add post</button>
            </form>
            <div class="dashboard-list">
                @forelse ($posts as $post)
                    <article class="dashboard-card">
                        <h3>{{ $post->title }}</h3>
                        <p class="dashboard-meta">
                            By {{ $post->user->name }} · {{ $post->created_at->format('M j, Y') }}
                        </p>
                        <p class="dashboard-body">{{ $post->body }}</p>

                        <div class="dashboard-comments">
                            <strong>{{ $post->comments_count }} comments</strong>
                            @if ($post->comments->isNotEmpty())
                                <ul>
                                    @foreach ($post->comments as $comment)
                                        <li>{{ $comment->body }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @php($commentField = 'comment_body_'.$post->getKey())
                            <form
                                class="dashboard-comment-form"
                                method="POST"
                                action="{{ route('comments.store', $post) }}"
                            >
                                @csrf
                                <label class="visually-hidden" for="{{ $commentField }}">Add a comment</label>
                                <textarea
                                    id="{{ $commentField }}"
                                    name="{{ $commentField }}"
                                    placeholder="Add a comment"
                                    required
                                >{{ old($commentField) }}</textarea>
                                <button type="submit">Add comment</button>
                                @error($commentField)
                                    <span class="dashboard-error">{{ $message }}</span>
                                @enderror
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="dashboard-empty">No posts have been added yet.</p>
                @endforelse
            </div>
        </section>

        <div class="dashboard-grid">
            <section class="dashboard-section">
                <h2>Courses and students</h2>
                <form class="dashboard-student-form dashboard-course-form" method="POST" action="{{ route('courses.store') }}">
                    @csrf
                    <label class="visually-hidden" for="course-title">Course title</label>
                    <input
                        id="course-title"
                        type="text"
                        name="course_title"
                        value="{{ old('course_title') }}"
                        placeholder="Course title"
                        maxlength="255"
                        required
                    >
                    <button type="submit">Add course</button>
                </form>
                @error('course_title')
                    <p class="dashboard-error">{{ $message }}</p>
                @enderror
                <div class="dashboard-list">
                    @forelse ($courses as $course)
                        <article class="dashboard-card">
                            <h3>{{ $course->title }}</h3>
                            <p>{{ $course->students_count }} enrolled students</p>
                        </article>
                    @empty
                        <p class="dashboard-empty">No courses have been added yet.</p>
                    @endforelse
                </div>
            </section>

            <section class="dashboard-section">
                <h2>Students</h2>
                <form class="dashboard-student-form" method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <label class="visually-hidden" for="student-name">Student name</label>
                    <input
                        id="student-name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Student name"
                        maxlength="255"
                        required
                    >
                    <button type="submit">Add student</button>
                </form>
                @error('name')
                    <p class="dashboard-error">{{ $message }}</p>
                @enderror
                <div class="dashboard-list">
                    @forelse ($students as $student)
                        <article class="dashboard-card">
                            <h3>{{ $student->name }}</h3>
                            <p>
                                Courses:
                                {{ $student->courses->pluck('title')->join(', ') ?: 'Not enrolled' }}
                            </p>
                        </article>
                    @empty
                        <p class="dashboard-empty">No students have been added yet.</p>
                    @endforelse
                </div>
            </section>
        </div>

        <section class="dashboard-section">
            <h2>Phone records</h2>
            <form class="dashboard-phone-form" method="POST" action="{{ route('phone-records.store') }}">
                @csrf
                <label class="visually-hidden" for="contact-name">Contact name</label>
                <input
                    id="contact-name"
                    type="text"
                    name="contact_name"
                    value="{{ old('contact_name') }}"
                    placeholder="Contact name"
                    maxlength="255"
                    required
                >
                <label class="visually-hidden" for="phone-number">Phone number</label>
                <input
                    id="phone-number"
                    type="tel"
                    name="phone_number"
                    value="{{ old('phone_number') }}"
                    placeholder="Phone number"
                    maxlength="255"
                    required
                >
                <button type="submit">Add phone record</button>
            </form>
            @error('contact_name')
                <p class="dashboard-error">{{ $message }}</p>
            @enderror
            @error('phone_number')
                <p class="dashboard-error">{{ $message }}</p>
            @enderror
            <div class="dashboard-grid">
                @forelse ($userPhones as $userPhone)
                    <article class="dashboard-card">
                        <h3>{{ $userPhone->name }}</h3>
                        @forelse ($userPhone->phones as $phone)
                            <p>{{ $phone->phone_number }}</p>
                        @empty
                            <p>No phone numbers recorded.</p>
                        @endforelse
                    </article>
                @empty
                    <p class="dashboard-empty">No phone records have been added yet.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-layout>
