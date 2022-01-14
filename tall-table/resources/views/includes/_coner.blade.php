<div class="flex items-center">
    <div class="flex-shrink-0 h-10 w-10">
        <img class="h-10 w-10 rounded-full" src="{{ $model->profile_photo_url }}" alt="{{ $model->name }}">
    </div>
    <div class="ml-4">
        <div class="text-sm font-medium text-gray-900">
            {{ $model->name }}
        </div>
        <div class="text-sm text-gray-500">
            {{ $model->email }}
        </div>
    </div>
</div>
