@extends('layout.admin.index')

@section('html')
<form class="admin-form" action="">
    <div class="admin-form__inputs">
        <label class="admin-label">
            <span class="admin-label__title">Поле</span>
            <input class="admin-input admin-label__input" type="text">
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