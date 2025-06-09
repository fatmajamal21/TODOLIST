<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>نظام المهام اليومية</title>

    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --warning-color: #f8961e;
            --info-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h1 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }
        
        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--success-color));
            border-radius: 3px;
        }
        
        /* تحسين نموذج الإضافة */
        .add-task-form {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }
        
        .add-task-form label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .add-task-form .form-control,
        .add-task-form .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        
        .add-task-form .form-control:focus,
        .add-task-form .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .add-task-form .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .add-task-form .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        /* تحسين تصميم الجدول */
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .table {
            font-family: 'Tajawal', sans-serif;
            font-size: 14px;
            color: #495057;
            border: none;
            margin-bottom: 0;
        }
        
        .table thead {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .table th {
            font-weight: 600;
            text-align: center;
            padding: 15px;
            border: none;
        }
        
        .table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            border-top: 1px solid #f1f1f1;
            background-color: white;
        }
        
        .table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        /* تخصيص الأزرار */
        .btn {
            font-weight: 500;
            border-radius: 8px;
            padding: 8px 15px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn i {
            margin-left: 5px;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }
        
        .btn-info {
            background-color: var(--info-color);
            border-color: var(--info-color);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
        }
        
        /* تخصيص زر الحالة */
        .status-toggle-btn {
            min-width: 110px;
            font-weight: 500;
        }
        
        /* تخصيص البادجات */
        .badge {
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        .badge-success {
            background-color: var(--success-color);
        }
        
        /* تحسين الأخطاء */
        .text-danger {
            font-size: 13px;
            font-weight: 500;
        }
        
        /* تحسين التوافق مع الأجهزة الصغيرة */
        @media (max-width: 768px) {
            .add-task-form .col-md-6 {
                margin-bottom: 15px;
            }
            
            .table td, .table th {
                padding: 8px 5px;
                font-size: 13px;
            }
            
            .btn-sm {
                padding: 4px 8px;
                font-size: 12px;
            }
            
            .status-toggle-btn {
                min-width: 90px;
            }
            
            .d-flex.gap-2 {
                flex-direction: column;
                gap: 5px !important;
            }
        }
        
        /* تأثيرات للجدول */
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            transform: translateX(5px);
        }
        
        /* تخصيص DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            margin: 0 3px;
            padding: 5px 10px;
            border: 1px solid #dee2e6 !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color)) !important;
            color: white !important;
            border: none !important;
        }
    </style>
</head>
<body>
<main class="page-content">
    <div class="container mt-4">
        <h1 class="mb-4">نظام المهام اليومية</h1>

        <!-- نموذج إضافة مهمة -->
        <form action="{{ route('task.add') }}" method="POST" class="add-task-form">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="title" class="form-label">المهمة</label>
                    <input type="text" name="title" id="title" class="form-control" required placeholder="أدخل عنوان المهمة" />
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="day" class="form-label">اليوم</label>
                    <select name="day" class="form-select">
                        @php
                            $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
                            $todayIndex = date('w');
                        @endphp
                        @foreach($days as $index => $day)
                            <option value="{{ $day }}" {{ $index == $todayIndex ? 'selected' : '' }}>
                                {{ $day }} {{ $index == $todayIndex ? '- اليوم' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="start_time" class="form-label">وقت البدء</label>
                    <input type="time" name="start_time" id="start_time" class="form-control" required />
                    @error('start_time')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="end_time" class="form-label">وقت الانتهاء</label>
                    <input type="time" name="end_time" id="end_time" class="form-control" required />
                    @error('end_time')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <button class="btn btn-primary w-100" type="submit">
                <i class="fas fa-plus-circle"></i> إضافة مهمة جديدة
            </button>
        </form>

        <!-- جدول عرض المهام -->
        <div class="table-responsive">
            <table class="table table-hover" id="tasksTable">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">المهمة</th>
                        <th width="15%">اليوم</th>
                        <th width="10%">وقت البدء</th>
                        <th width="10%">وقت الانتهاء</th>
                        <th width="12%">الحالة</th>
                        <th width="13%">تاريخ الإضافة</th>
                        <th width="15%">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $task->title }}</td>
                            <td>
                                {{ $task->day }}
                                @php
                                    $todayArabic = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'][date('w')];
                                @endphp
                                @if($task->day == $todayArabic)
                                    <span class="badge badge-success">اليوم</span>
                                @endif
                            </td>
                            <td>{{ $task->start_time ?? '-' }}</td>
                            <td>{{ $task->end_time ?? '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm status-toggle-btn {{ ($task->status ?? 'غير منجز') == 'منجز' ? 'btn-success' : 'btn-warning' }}" data-id="{{ $task->id }}" data-status="{{ $task->status ?? 'غير منجز' }}">
                                    <i class="fas {{ ($task->status ?? 'غير منجز') == 'منجز' ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                    {{ ($task->status ?? 'غير منجز') == 'منجز' ? 'تم الإنجاز' : 'غير منجز' }}
                                </button>
                            </td>
                            <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-sm btn-info update-btn" data-id="{{ $task->id }}" data-title="{{ $task->title }}" data-day="{{ $task->day }}" data-start-time="{{ $task->start_time }}" data-end-time="{{ $task->end_time }}">
                                        <i class="fas fa-edit"></i> تعديل
                                    </button>
                                    <form action="{{ route('task.delete', $task->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المهمة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">لا توجد مهام مضافة حتى الآن</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- إضافة سكريبتات الجافا سكربت -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    // تهيئة DataTable
    $('#tasksTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
        },
        responsive: true,
        order: [[6, 'desc']],
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>',
        initComplete: function() {
            $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'ابحث في المهام...');
            $('.dataTables_length select').addClass('form-select');
        }
    });
    
    // تغيير حالة المهمة
    $(document).on('click', '.status-toggle-btn', function() {
        const btn = $(this);
        const taskId = btn.data('id');
        const currentStatus = btn.data('status');
        const newStatus = currentStatus === 'منجز' ? 'غير منجز' : 'منجز';
        
        $.ajax({
            url: '/task/update-status/' + taskId,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    btn.removeClass(currentStatus === 'منجز' ? 'btn-success' : 'btn-warning')
                       .addClass(newStatus === 'منجز' ? 'btn-success' : 'btn-warning')
                       .data('status', newStatus)
                       .html(`<i class="fas ${newStatus === 'منجز' ? 'fa-check-circle' : 'fa-clock'}"></i> ${newStatus === 'منجز' ? 'تم الإنجاز' : 'غير منجز'}`);
                }
            },
            error: function() {
                alert('حدث خطأ أثناء تحديث الحالة');
            }
        });
    });
    
    // تعديل المهمة (يحتاج إلى مودال)
    $(document).on('click', '.update-btn', function() {
        // يمكنك إضافة كود فتح مودال التعديل هنا
        alert('سيتم فتح نموذج التعديل للمهمة: ' + $(this).data('title'));
    });
</script>

</body>
</html>