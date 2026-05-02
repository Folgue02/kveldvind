<form action="{{ route('workout.exercise.store') }}" method="POST">
    @csrf

    <div class="exercise-header-line">
        <div class="icon-section">
            <label for="icon">ICON</label>
            <input type="file" name="icon">
        </div>
        <div class="title-section">
            <label for="name">NAME</label>
            <input type="text" name="name">
        </div>
    </div>

    <div class="attachments-line">

    </div>
</form>
