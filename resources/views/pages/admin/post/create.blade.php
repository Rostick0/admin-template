@extends('layout.admin.index')

@section('html')
<form class="admin-form" action="" method="post">
    <!-- 'title',
    'content',
    'user_id',
    'rubric_id',
    'source',
    'count_view',
    'status',
    'is_private',
    'date_publication', -->
    <div class="admin-form__inputs">
        <label class="admin-label _error">
            <span class="admin-label__title">Заголовок</span>
            <input class="admin-input admin-label__input" type="text" name="title">
            <span class="admin-label__error">Ошибочка</span>
        </label>
        <label class="admin-label">
            <span class="admin-label__title">Поле</span>
            <input class="admin-input admin-label__input" type="text">
        </label>
        <label class="admin-label">
            <span class="admin-label__title">Поле</span>
            <input class="admin-input admin-label__input" type="text">
        </label>
    </div>
    <button class="admin-btn admin-form__btn">Создать</button>
</form>
@endsection

@section('js')

<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
@vite(['resources/js/pages/admin/post/create.js'])
@endsection