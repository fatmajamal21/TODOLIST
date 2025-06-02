<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام المهام اليومية</title>
    
    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .page-content {
            min-height: 100vh;
        }
        .badge {
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<main class="page-content">
    <div class="container">
        <h1 class="mb-4">المهام اليومية</h1>

        <!-- نموذج إضافة مهمة -->
        <!-- Modal التعديل -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">تعديل المهمة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="editTitle" class="form-label">المهمة</label>
            <input type="text" class="form-control" id="editTitle" name="title" required>
          </div>
          <div class="mb-3">
            <label for="editDay" class="form-label">اليوم</label>
            <select class="form-select" id="editDay" name="day" required>
              @php
                $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
              @endphp
              @foreach($days as $day)
                <option value="{{ $day }}">{{ $day }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="editStartTime" class="form-label">وقت البدء</label>
            <input type="time" class="form-control" id="editStartTime" name="start_time" required>
          </div>
          <div class="mb-3">
            <label for="editEndTime" class="form-label">وقت الانتهاء</label>
            <input type="time" class="form-control" id="editEndTime" name="end_time" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- نموذج إضافة مهمة -->
<form action="{{ route('home.add') }}" method="POST" class="mb-4">
    @csrf
    <div class="input-group mb-2">
        <input type="text" name="title" class="form-control" placeholder="أدخل مهمة جديدة" required>
        <select name="day" class="form-select" style="max-width: 180px;">
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

    <div class="input-group mb-3">
        <label class="input-group-text" for="start_time">وقت البدء</label>
        <input type="time" name="start_time" id="start_time" class="form-control" required>
        <label class="input-group-text" for="end_time">وقت الانتهاء</label>
        <input type="time" name="end_time" id="end_time" class="form-control" required>
    </div>

    <button class="btn btn-primary col-12 " type="submit">إضافة</button>

    @error('title')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    @error('start_time')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    @error('end_time')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</form>

        <!-- جدول عرض المهام -->
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tasksTable">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th>المهمة</th>
                        <th>اليوم</th>
                         <th>وقت البدء</th>
                          <th>وقت الانهاء</th>
                        <th>تاريخ الإضافة</th>
                        <th width="20%">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
            <td>
          @php
          $todayArabic = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'][date('w')];
          @endphp
    
          {{ $task->day }}
         @if($task->day == $todayArabic)
        <span class="badge bg-success">اليوم</span>
    @endif
</td>
<td>{{ $task->start_time ?? '-' }}</td>
<td>{{ $task->end_time ?? '-' }}</td>

                            <td>{{ $task->created_at->format('m-d H:i') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- زر التعديل -->
                        <button class="btn btn-sm btn-info edit-btn"
                                  data-id="{{ $task->id }}"
                                  data-title="{{ $task->title }}"
                                  data-day="{{ $task->day }}"
                                  data-start-time="{{ $task->start_time }}"
                                  data-end-time="{{ $task->end_time }}">
                                  <i class="fas fa-edit"></i> تعديل
                         </button>
                                    
                                    <!-- زر الحذف -->
                                    <form action="{{ route('home.delete', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete_btn btn btn-sm btn-danger" 
                                            onclick="return confirm('هل أنت متأكد من حذف المهمة؟')">
                                            <i class="fas fa-trash"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">لا توجد مهام  </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Custom JS -->
@section('js')
<script>
   $(document).ready(function() {
    // معالجة فتح Modal التعديل
    $('.edit-btn').on('click', function() {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var day = $(this).data('day');
        var startTime = $(this).data('start-time');
        var endTime = $(this).data('end-time');

        $('#editTitle').val(title);
        $('#editDay').val(day);
        $('#editStartTime').val(startTime);
        $('#editEndTime').val(endTime);
        $('#editForm').attr('action', '/TODOLIST/home/update/' + id);

        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    });

$(document).on('click', '.delete_btn', function(e) {
    e.preventDefault();

    let button = $(this);
    let id = button.data('id'); // لازم الـ button يحمل data-id

    if (!id) {
        Swal.fire('خطأ!', 'لم يتم تحديد المهمة للحذف.', 'error');
        return;
    }

    Swal.fire({
        title: 'هل أنت متأكد من الحذف؟',
        text: "لن تتمكن من التراجع عن هذا!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'نعم، احذف',
        cancelButtonText: 'إلغاء',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/TODOLIST/home/delete/' + id, // id في الرابط
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'تم الحذف!',
                        'تم حذف المهمة بنجاح.',
                        'success'
                    ).then(() => {
                        // إعادة تحميل الصفحة أو إعادة تحميل الجدول
                        location.reload(); // أو اعمل تحديث للـ DataTable فقط
                    });
                },
                error: function(xhr) {
                    let errorMessage = 'حدث خطأ أثناء الحذف.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('خطأ!', errorMessage, 'error');
                }
            });
        }
    });
});


    // إعادة تعيين النموذج عند إغلاق Modal التعديل
    $('#editModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });

    // تهيئة DataTable
    $('#tasksTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
        },
        responsive: true,
        order: [[3, 'desc']]
    });
});
</script>
@stop

</body>
</html>