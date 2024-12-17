@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    <section class="page-header py-5 text-center text-white">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">🏆 Leaderboard</h1>
            <p class="lead animate__animated animate__fadeInUp">Top members with the highest points!</p>
        </div>
    </section>

    <!-- Leaderboard Table Section -->
    <section class="leaderboard py-5">
        <div class="container">
            @if($members->isEmpty())
                <div class="alert alert-warning text-center">
                    <h4 class="animate__animated animate__bounceIn">No members are currently on the leaderboard.</h4>
                </div>
            @else
                <div class="table-responsive animate__animated animate__fadeInUp">
                    <table class="table table-borderless text-center align-middle shadow-sm">
                        <thead class="table-header">
                            <tr>
                                <th scope="col" class="text-uppercase fw-bold">Rank</th>
                                <th scope="col" class="text-uppercase fw-bold">Name</th>
                                <th scope="col" class="text-uppercase fw-bold">Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $index => $member)
                                <tr class="table-row">
                                    <!-- Rank with Highlight for Top 3 -->
                                    <td class="fw-bold">
                                        @if($index == 0)
                                            <span class="rank-badge gold">🥇 #{{ $index + 1 }}</span>
                                        @elseif($index == 1)
                                            <span class="rank-badge silver">🥈 #{{ $index + 1 }}</span>
                                        @elseif($index == 2)
                                            <span class="rank-badge bronze">🥉 #{{ $index + 1 }}</span>
                                        @else
                                            #{{ $index + 1 }}
                                        @endif
                                    </td>

                                    <!-- Member Name -->
                                    <td class="text-secondary fw-semibold">{{ $member->userName }}</td>

                                    <!-- Member Points -->
                                    <td class="text-success fw-bold">
                                        <i class="bi bi-trophy-fill text-warning"></i> {{ $member->memberPoints }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>

    <style>
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        .table {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background-color: #28a745;
            color: white;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .table-row {
            transition: transform 0.2s, box-shadow 0.3s;
        }

        .table-row:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background-color: #f8f9fa;
        }

        /* Rank Badges */
        .rank-badge {
            display: inline-block;
            font-size: 1rem;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .gold {
            background-color: #ffd700;
            color: #fff;
        }

        .silver {
            background-color: #c0c0c0;
            color: #fff;
        }

        .bronze {
            background-color: #cd7f32;
            color: #fff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem;
            }

            .rank-badge {
                padding: 3px 8px;
            }
        }
    </style>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
@endsection
