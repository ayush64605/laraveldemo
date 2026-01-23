<?php
if (!function_exists('handle_setting_upload')) {
    function handle_setting_upload($request, $currentModel, $field, $path = 'settings/general')
    {
        if ($request->boolean("remove_{$field}")) {
            if ($currentModel->$field) {
                Storage::disk('public')->delete($currentModel->$field);
            }
            return null;
        }

        if ($request->hasFile($field)) {
            if ($currentModel->$field) {
                Storage::disk('public')->delete($currentModel->$field);
            }
            return $request->file($field)->store($path, 'public');
        }

        return $currentModel->$field;
    }
}
