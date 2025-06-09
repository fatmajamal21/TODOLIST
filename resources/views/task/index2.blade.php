<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <title>نظام المهام اليومية</title>
      <link rel="icon" href="{{ asset('assets/img/task.png') }}" type="image/png">

          <!-- لأجهزة Apple -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/task.png') }}">
    
    <!-- باقي الروابط -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

    <!-- Tajawal Arabic Font -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary-color: #4a6fa5;
    --secondary-color: #166d67;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    --border-radius: 8px;
    --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

body {
    font-family: 'Tajawal', sans-serif;
    background-color: #f5f7fa;
    color: #333;
    line-height: 1.6;
}

/* تحسينات عامة للصفحة */
.container {
    max-width: 1200px;
    padding: 20px;
    margin: 30px auto;
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

h1 {
    color: var(--primary-color);
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #eee;
}

/* تحسين نموذج الإضافة */
form {
    background-color: white;
    padding: 25px;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 30px;
    border: 1px solid #e0e0e0;
}

.input-group {
    margin-bottom: 15px;
}

.input-group-text {
    background-color: var(--primary-color);
    color: white;
    border: none;
    font-weight: 500;
}

.form-control, .form-select {
    border: 1px solid #ddd;
    transition: var(--transition);
    height: 45px;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(74, 111, 165, 0.25);
}

.btn-primary {
    background-color: var(--primary-color);
    border: none;
    padding: 10px 20px;
    font-weight: 500;
    transition: var(--transition);
}

.btn-primary:hover {
    background-color: #3a5a8c;
    transform: translateY(-2px);
}

/* تحسينات الجدول */
.table-responsive {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
}

.table {
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.table-dark {
    background: linear-gradient(135deg, var(--primary-color), #2c3e50);
}

.table-dark th {
    padding: 15px;
    text-align: center;
    font-weight: 600;
    border: none;
    color: white;
}

.table-hover tbody tr:hover {
    background-color: rgba(74, 111, 165, 0.05);
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.02);
}

.table td {
    padding: 12px 15px;
    vertical-align: middle;
    border-top: 1px solid #eee;
}

/* تحسينات الأزرار */
.btn {
    border-radius: var(--border-radius);
    font-weight: 500;
    transition: var(--transition);
    padding: 8px 15px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn i {
    margin-left: 5px;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 14px;
}

.btn-success {
    background-color: var(--success-color);
}

.btn-warning {
    background-color: var(--warning-color);
    color: #212529;
}

.btn-info {
    background-color: var(--info-color);
}

.btn-danger {
    background-color: var(--danger-color);
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    opacity: 0.9;
}

/* تحسينات البادجات */
.badge {
    font-size: 0.75em;
    padding: 5px 10px;
    font-weight: 500;
    border-radius: 50px;
}

.badge.bg-success {
    background-color: var(--success-color) !important;
}

/* تحسينات المودال */
.modal-content {
    border-radius: var(--border-radius);
    border: none;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
}

.modal-header {
    background: linear-gradient(135deg, var(--primary-color), #2c3e50);
    color: white;
    border-bottom: none;
    border-radius: var(--border-radius) var(--border-radius) 0 0;
}

.modal-title {
    font-weight: 700;
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    border-top: 1px solid #eee;
    padding: 15px 25px;
}

/* تحسينات خاصة للواجهة العربية */
[dir="rtl"] .input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
    border-radius: var(--border-radius) 0 0 var(--border-radius);
    margin-right: -1px;
}

[dir="rtl"] .input-group > :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
    border-radius: 0 var(--border-radius) var(--border-radius) 0;
}

.dataTables_length,
.dataTables_filter,
.dataTables_info {
    display: none !important;
}
/* تحسينات للهواتف */
@media (max-width: 768px) {
    .container {
        padding: 15px;
        margin: 15px auto;
    }
    
    .table td, .table th {
        padding: 8px 10px;
        font-size: 14px;
    }
    
    .btn {
        padding: 6px 10px;
        font-size: 14px;
    }
    
    form {
        padding: 15px;
    }
}

/* تأثيرات خاصة */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.table tbody tr {
    animation: fadeIn 0.3s ease forwards;
    opacity: 0;
}

.table tbody tr:nth-child(1) { animation-delay: 0.1s; }
.table tbody tr:nth-child(2) { animation-delay: 0.2s; }
.table tbody tr:nth-child(3) { animation-delay: 0.3s; }
.table tbody tr:nth-child(4) { animation-delay: 0.4s; }
.table tbody tr:nth-child(5) { animation-delay: 0.5s; }

/* تأثيرات النقر على الأزرار */
.btn:active {
    transform: translateY(0);
}

/* رسائل التنبيه */
.alert {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
    min-width: 300px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    border: none;
}

/* تحسينات شريط البحث في DataTables */
.dataTables_filter input {
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    padding: 5px 10px;
    margin-right: 10px;
}

/* تحسينات التباين وإمكانية الوصول */
:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* تحسينات خاصة لزر تغيير الحالة */
.status-toggle-btn {
    min-width: 110px;
    position: relative;
    overflow: hidden;
}

.status-toggle-btn:after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%, -50%);
    transform-origin: 50% 50%;
}

.status-toggle-btn:focus:not(:active)::after {
    animation: ripple 0.6s ease-out;
}

@keyframes ripple {
    0% {
        transform: scale(0, 0);
        opacity: 0.5;
    }
    100% {
        transform: scale(20, 20);
        opacity: 0;
    }
}

/* تحسينات الصفوف الفارغة */
.text-center {
    color: #6c757d;
    font-style: italic;
    padding: 20px;
}

/* تحسينات مجموعة الأزرار */
.d-flex.gap-2 {
    justify-content: center;
}

/* تحسينات خاصة لزر الحذف */
.btn-danger:hover {
    background-color: #c82333;
}

/* تحسينات خاصة لزر التعديل */
.btn-info:hover {
    background-color: #138496;
}

/* تحسينات خاصة لزر الحالة */
.btn-success:hover {
    background-color: #218838;
}

.btn-warning:hover {
    background-color: #e0a800;
}
</style>
</head>
<body>
<main class="page-content">
    <div class="container">
        <h1 class="mb-4">نظام إدارة المهام اليومية</h1>
<!-- رسائل التنبيه -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 300px;">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
        <!-- نموذج إضافة مهمة -->
        <form action="{{ route('task.add') }}" method="POST" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                        <input type="text" name="title" id="title" class="form-control" placeholder="أدخل عنوان المهمة" required />
                    </div>
                    @error('title')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        <select name="day" class="form-select" required>
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
                </div>
                
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                        <input type="time" name="start_time" id="start_time" class="form-control" required />
                    </div>
                    @error('start_time')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                        <input type="time" name="end_time" id="end_time" class="form-control" required />
                    </div>
                    @error('end_time')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="col-12">
                    <button class="btn btn-primary w-100 py-2" type="submit">
                        <i class="fas fa-plus-circle"></i> إضافة مهمة جديدة
                    </button>
                </div>
                <div class="col-12">
                    <a href="{{ route('task.show') }}" class="btn btn-info w-100 py-2">
                        <i class="fas fa-list"></i> عرض صفحة المهام
                    </a>
                </div>
            </div>
        </form>

        <!-- جدول عرض المهام -->
        {{-- <div class="table-responsive">
            <table class="table table-hover table-striped" id="tasksTable">
                <thead class="table-info">
                    <tr>
                        <th width="5%">#</th>
                        <th>المهمة</th>
                        <th width="12%">اليوم</th>
                        <th width="10%">وقت البدء</th>
                        <th width="10%">وقت الانتهاء</th>
                        <th width="12%">الحالة</th>
                        <th width="12%">تاريخ الإضافة</th>
                        <th width="18%">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            {{ $task->day }}
                            @php
                                $todayArabic = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'][date('w')];
                            @endphp
                            @if($task->day == $todayArabic)
                                <span class="badge bg-success">اليوم</span>
                            @endif
                        </td>
                        <td>{{ $task->start_time ?? '-' }}</td>
                        <td>{{ $task->end_time ?? '-' }}</td>
                        <td>
                            <button type="button" 
                                    class="btn btn-sm status-toggle-btn {{ ($task->status ?? 'غير منجز') == 'منجز' ? 'btn-success' : 'btn-warning' }}"
                                 data-id="{{ $task->id }}"
                                data-status="{{ $task->status ?? 'غير منجز' }}">
                               {{ ($task->status ?? 'غير منجز') == 'منجز' ? 'تم الإنجاز' : 'غير منجز' }}
                            </button>
                        </td>
                        <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <div class=" d-flex gap-2 justify-content-center">
                                <form style="background-color: #cfe2ff" action="">
                                <button type="button" 
                                style="height: 40px"
                                    class="btn btn-sm btn btn-primary w-100 py-2 update-btn" 
                                    data-id="{{ $task->id }}"
                                    data-title="{{ $task->title }}"
                                    data-day="{{ $task->day }}" 
                                    data-start-time="{{ $task->start_time }}" 
                                    data-end-time="{{ $task->end_time }}"
                                    data-status="{{ $task->status ?? 'غير منجز' }}">
                                    <i class="fas fa-edit"></i> تعديل
                                </button>
                                </form>

                                <form style="background-color: #cfe2ff" action="{{ route('task.delete', $task->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المهمة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button  style="height: 40px"" type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">لا توجد مهام مضافة حالياً</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div> --}}
    </div>
</main>

<!-- مودال التعديل -->
{{-- <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" dir="rtl">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="updateForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel"><i class="fas fa-edit"></i> تعديل المهمة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="updateTaskId" />
          <div class="mb-3">
            <label for="updateTitle" class="form-label">عنوان المهمة</label>
            <input type="text" class="form-control" id="updateTitle" name="title" required />
          </div>
          <div class="row g-3">
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="updateDay" class="form-label">اليوم</label>
                    <select class="form-select" id="updateDay" name="day" required>
                        @foreach($days as $day)
                          <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="updateStatus" class="form-label">حالة المهمة</label>
                    <select class="form-select" id="updateStatus" name="status" required>
                        <option value="غير منجز">غير منجز</option>
                        <option value="منجز">تم الإنجاز</option>
                    </select>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="updateStartTime" class="form-label">وقت البدء</label>
                    <input type="time" class="form-control" id="updateStartTime" name="start_time" required />
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="updateEndTime" class="form-label">وقت الانتهاء</label>
                    <input type="time" class="form-control" id="updateEndTime" name="end_time" required />
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> إغلاق</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> حفظ التغييرات</button>
        </div>
      </form>
    </div>
  </div>
</div> --}}

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
// تهيئة DataTable مع ترجمة عربية
$(document).ready(function() {

        setTimeout(() => {
        $('.alert').alert('close');
    }, 5000);
    
    // إخفاء التنبيه عند النقر على زر الإغلاق
    $('.alert .btn-close').click(function() {
        $(this).parent().alert('close');
    });
    $('#tasksTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
        },
        responsive: true,
        order: [[6, 'desc']],
        dom: '<"top"lf>rt<"bottom"ip>',
        initComplete: function() {
            $('.dataTables_filter input').attr('placeholder', 'ابحث في المهام...');
        }
    });
});

// تحديث حالة المهمة
// $(document).on('click', '.status-toggle-btn', function() {
//     const btn = $(this);
//     const taskId = btn.data('id');
//     const currentStatus = btn.data('status');
//     const newStatus = currentStatus === 'منجز' ? 'غير منجز' : 'منجز';
    
//     $.ajax({
//         url: '/TODOLIST/task/toggleStatus/' + taskId,
//         type: 'POST',
//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content'),
//             status: newStatus
//         },
//         dataType: 'json',
//         beforeSend: function() {
//             btn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
//         },
//         success: function(response) {
//             if(response.success) {
//                 btn.removeClass('btn-warning btn-success')
//                    .addClass(response.btn_class)
//                    .text(response.status_text)
//                    .data('status', response.new_status);
                
//                 showAlert('تم تحديث حالة المهمة بنجاح', 'success');
//             }
//         },
//         error: function(xhr) {
//             console.error(xhr);
//             showAlert('حدث خطأ أثناء تحديث الحالة', 'danger');
//         },
//         complete: function() {
//             btn.prop('disabled', false);
//         }
//     });
// });

// مودال التعديل
// $(document).on('click', '.update-btn', function() {
//     const taskId = $(this).data('id');
//     const taskTitle = $(this).data('title');
//     const taskDay = $(this).data('day');
//     const taskStartTime = $(this).data('start-time');
//     const taskEndTime = $(this).data('end-time');
//     const taskStatus = $(this).data('status');

//     $('#updateTaskId').val(taskId);
//     $('#updateTitle').val(taskTitle);
//     $('#updateDay').val(taskDay);
//     $('#updateStartTime').val(taskStartTime);
//     $('#updateEndTime').val(taskEndTime);
//     $('#updateStatus').val(taskStatus);

//     // تحديث رابط الفورم
//     $('#updateForm').attr('action', '/TODOLIST/task/update/' + taskId);

//     // عرض المودال
//     const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
//     updateModal.show();
// });



// دالة لعرض الرسائل
function showAlert(message, type) {
    const alert = $(`
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `);
    
    $('body').append(alert);
    
    // إخفاء التنبيه تلقائياً بعد 3 ثواني
    setTimeout(() => {
        alert.alert('close');
    }, 3000);
}

// تأكيد الحذف
$(document).on('submit', 'form[onsubmit]', function(e) {
    if (!confirm('هل أنت متأكد من حذف هذه المهمة؟')) {
        e.preventDefault();
    }
});
// في نهاية ملف JavaScript
@if(session('success'))
    showAlert('{{ session('success') }}', 'success');
@endif
</script>
</body>
</html>