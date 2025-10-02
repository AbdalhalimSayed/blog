@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <div class="quick-actions">
                <div class="btn-group">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm"></i> New Post
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-success shadow-sm ml-2">
                        <i class="fas fa-plus fa-sm"></i> New Category
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-info shadow-sm ml-2">
                        <i class="fas fa-plus fa-sm"></i> New User
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        {{-- @if (auth()->user()->unreadNotifications->count() > 0)
            <div class="notifications mb-4">
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <div class="alert alert-{{ $notification->data['type'] ?? 'info' }} alert-dismissible fade show">
                        {{ $notification->data['message'] }}
                        <button type="button" class="close mark-as-read" data-id="{{ $notification->id }}">
                            <span>&times;</span>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif --}}

        <!-- Stats Cards -->
        <div class="row">
            <!-- Users Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Posts Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Posts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $postsCount }}</div>
                                <div class="mt-2">
                                    <span class="badge text-bg-success">Published: {{ $publishedPostsCount }}</span>
                                    <span class="badge text-bg-warning ml-1">Drafts: {{ $draftsCount }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.posts.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Categories Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Categories</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categoriesCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tags fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.categories.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Comments Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Comments</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $commentsCount }}</div>
                                <div class="mt-2">
                                    <span class="badge text-bg-success">Approved: {{ $approvedCommentsCount }}</span>
                                    <span class="badge text-bg-secondary ml-1">Pending: {{ $pendingCommentsCount }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.comments.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
            <!-- Posts Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Posts Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="postsChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> This Month: {{ $monthlyPostsCount }}
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Last Month: {{ $lastMonthPostsCount }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Comments Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="commentsChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> This Month: {{ $monthlyCommentsCount }}
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Last Month: {{ $lastMonthCommentsCount }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Latest Posts -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Latest Posts</h6>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($latestPosts as $post)
                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $post->title }}</h6>
                                        {{-- <small>{{ $post->created_at->diffForHumans() }}</small> --}}
                                    </div>
                                    <p class="mb-1 text-truncate">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                                    <small class="text-muted">Category: {{ $post->category->name }}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Comments -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Comments</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($latestComments as $comment)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                        {{-- <small>{{ $comment->created_at->diffForHumans() }}</small> --}}
                                    </div>
                                    <p class="mb-1">{{ Str::limit($comment->content, 100) }}</p>
                                    <small class="text-muted">
                                        On: <a href="{{ route('admin.posts.edit', $comment->commentable_id) }}">
                                            {{ Str::limit($comment->commentable->title, 30) }}
                                        </a>
                                    </small>
                                    <div class="mt-2 d-flex justify-content-between align-items-center">
                                        @if ($comment->status == 'published')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                        <a href="{{ route('admin.comments.edit', $comment->id) }}"
                                            class="btn btn-sm btn-outline-primary">Manage</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Log -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart.js -->
    <script>
        // Posts Chart
        var ctx = document.getElementById('postsChart').getContext('2d');
        var postsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Seb', 'Oct', 'Nov', 'Des'],
                datasets: [{
                    label: 'Posts',
                    data: {!! json_encode($monthlyPosts) !!},
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Comments Chart
        var ctx2 = document.getElementById('commentsChart').getContext('2d');
        var commentsChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Seb', 'Oct', 'Nov', 'Des'],
                datasets: [{
                    label: 'Comments',
                    data: {!! json_encode($monthlyComment) !!},
                    backgroundColor: 'rgba(54, 185, 204, 0.5)',
                    borderColor: 'rgba(54, 185, 204, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Mark notifications as read
        $('.mark-as-read').click(function(e) {
            e.preventDefault();
            var notificationId = $(this).data('id');
            $.ajax({
                url: '/admin/notifications/' + notificationId + '/read',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $(this).closest('.alert').fadeOut();
                }.bind(this)
            });
        });
    </script>
@endsection
