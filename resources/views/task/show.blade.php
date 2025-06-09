<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>عرض المهام</title>

    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

    <!-- Tajawal Arabic Font -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
    /* نفس الستايل السابق تماماً */
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

    /* إضافة إلى ملف الـ CSS */
body:after {
    display: none !important;
}
    body {
        font-family: 'Tajawal', sans-serif;
        background-color: #f5f7fa;
        color: #333;
        line-height: 1.6;
    }
    .alert {
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    border: none;
    padding: 15px 20px;
    margin-bottom: 20px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-dismissible .btn-close {
    padding: 0.5rem;
}

/* إخفاء عناصر التذييل في DataTables */
.dataTables_info, 
.dataTables_paginate, 
.dataTables_length, 
.dataTables_filter {
    display: none !important;
}

/* إخفاء رسالة تنشيط ويندوز */
body:after {
    content: none !important;
}

    /* ... (بقية الستايل كما هو تماماً) ... */
    </style>
</head>
<body>
<main class="page-content">
    <div class="container">
        <br><br>
        <h1 class="mb-4">عرض المهام</h1>

        <div class="mb-4">
            <a href="{{ route('task.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-right"></i> العودة للصفحة الرئيسية
            </a>
        </div>
<!-- رسائل التنبيه -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
        <!-- جدول عرض المهام -->
        <div class="table-responsive">
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

                                <form style="background-color: #cfe2ff" action="{{ route('task.delete', $task->id) }}" method="POST" 
                                    {{-- onsubmit="return confirm('هل أنت متأكد من حذف المهمة؟');" --}}
                                    >
                                    @csrf
                                    @method('DELETE')
                                    <button  style="height: 40px" type="submit" class="btn btn-sm btn-danger">
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
        </div>
    </div>
</main>

<!-- مودال التعديل -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" dir="rtl">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="updateForm" method="POST">
        @csrf
        @method('POST')
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
</div>

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
        $('#tasksTable').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
            },
            "responsive": true,
            "order": [[6, 'desc']],
            "dom": 'rt<"bottom"ip>',  // إخفاء خيارات عرض المدخلات
            "initComplete": function() {
                $('.dataTables_filter').hide();  // إخفاء مربع البحث
                $('.dataTables_length').hide();  // إخفاء عدد المدخلات
                        // "paging": false, // تعطيل التقسيم الصفحي
            // "info": false // إخفاء معلومات السجلات
            }
        });
    });

// تحديث حالة المهمة
$(document).on('click', '.status-toggle-btn', function() {
    const btn = $(this);
    const taskId = btn.data('id');
    const currentStatus = btn.data('status');
    const newStatus = currentStatus === 'منجز' ? 'غير منجز' : 'منجز';
    
    $.ajax({
        url: '/TODOLIST/task/toggleStatus/' + taskId,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            status: newStatus
        },
        dataType: 'json',
        beforeSend: function() {
            btn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
        },
        success: function(response) {
            if(response.success) {
                btn.removeClass('btn-warning btn-success')
                   .addClass(response.btn_class)
                   .text(response.status_text)
                   .data('status', response.new_status);
                
                showAlert('تم تحديث حالة المهمة بنجاح', 'success');
            }
        },
        error: function(xhr) {
            console.error(xhr);
            showAlert('حدث خطأ أثناء تحديث الحالة', 'danger');
        },
        complete: function() {
            btn.prop('disabled', false);
        }
    });
});

// مودال التعديل
$(document).on('click', '.update-btn', function() {
    const taskId = $(this).data('id');
    const taskTitle = $(this).data('title');
    const taskDay = $(this).data('day');
    const taskStartTime = $(this).data('start-time');
    const taskEndTime = $(this).data('end-time');
    const taskStatus = $(this).data('status');

    $('#updateTaskId').val(taskId);
    $('#updateTitle').val(taskTitle);
    $('#updateDay').val(taskDay);
    $('#updateStartTime').val(taskStartTime);
    $('#updateEndTime').val(taskEndTime);
    $('#updateStatus').val(taskStatus);

    // تحديث رابط الفورم
    $('#updateForm').attr('action', '/TODOLIST/task/update/' + taskId);

    // عرض المودال
    const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
    updateModal.show();
});

// دالة لعرض الرسائل
function showAlert(message, type) {
    const alert = $(`
        <div class="alert alert-${type} alert-dismissible fade show mb-4" role="alert">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `);
    
    // إدراج الرسالة قبل الجدول مباشرة
    $('.table-responsive').before(alert);
    
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
</script>
</body>
</html>