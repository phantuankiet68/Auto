<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GeneratorController extends Controller
{
    public function index()
    {
        return view('generator');
    }
    
    public function generate(Request $request)
    {
        // Convert tiếng Việt có dấu thành không dấu và snake_case
        $tableNameInput = $request->table_name;
        $tableName = Str::slug($tableNameInput, '_'); // Ví dụ: "Học Kì" -> "hoc_ki"
    
        $columns = $request->columns;
    
        // Check trùng tên cột
        $columnNames = array_column($columns, 'name');
        if (count($columnNames) !== count(array_unique($columnNames))) {
            return back()->with('error', 'Tên cột không được trùng nhau!');
        }
    
        $modelName = ucfirst(Str::singular(Str::camel($tableName)));
        $controllerName = $modelName . 'Controller';
    
        $modelNameLower = Str::camel($modelName);

        Artisan::call("make:migration create_{$tableName}_table --create={$tableName}");
        Artisan::call("make:model {$modelName}");
        Artisan::call("make:controller {$controllerName} --resource");
    
        $this->updateModelFillable($modelName, $columns);
        $this->updateMigrationSchema($tableName, $columns);
        $this->updateControllerContent($controllerName, $modelName);
        $this->generateViews($modelNameLower);
        
        Artisan::call('migrate');
    
        return back()->with('success', 'Tạo bảng và migrate thành công!');
    }

    private function updateModelFillable($modelName, $columns)
    {
        $modelPath = app_path("Models/{$modelName}.php");
    
        $fillable = implode(",\n        ", array_map(function ($column) {
            return "'{$column['name']}'";
        }, $columns));
    
        $modelContent = <<<PHP
        <?php
        
        namespace App\Models;
        
        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;
        
        class {$modelName} extends Model
        {
            use HasFactory;
        
            protected \$fillable = [
                {$fillable}
            ];
        }
        PHP;
        File::put($modelPath, $modelContent);
    }
    

    private function updateMigrationSchema($tableName, $columns)
    {
        $migrationFile = $this->getMigrationFileName($tableName);

        if (!$migrationFile) {
            throw new \Exception('Không tìm thấy file migration!');
        }

        $migrationPath = database_path('migrations/' . $migrationFile);

        $schema = '';
        foreach ($columns as $column) {
            $name = $column['name'];
            $type = $column['type'] ?? 'string';
            $schema .= "\$table->{$type}('{$name}');\n            ";
        }

        file_put_contents($migrationPath, str_replace(
            '$table->id();',
            '$table->id();' . "\n            " . $schema,
            file_get_contents($migrationPath)
        ));
    }

    
    private function getMigrationFileName($tableName)
    {
        $files = File::files(database_path('migrations'));

        foreach ($files as $file) {
            if (Str::contains($file->getFilename(), "create_{$tableName}_table")) {
                return $file->getFilename();
            }
        }

        return null;
    }
    private function updateControllerContent($controllerName, $modelName)
    {
        $modelNameLower = Str::camel($modelName); 
        $modelNamePluralLower = Str::plural($modelNameLower);

        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");

        $controllerContent = <<<PHP
    <?php

    namespace App\Http\Controllers;

    use App\Models\\{$modelName};
    use Illuminate\Http\Request;

    class {$controllerName} extends Controller
    {
        public function index()
        {
            \${$modelNamePluralLower} = {$modelName}::all();
            return view('{$modelNameLower}.index', compact('{$modelNamePluralLower}'));
        }

        public function create()
        {
            return view('{$modelNameLower}.create');
        }

        public function store(Request \$request)
        {
            {$modelName}::create(\$request->all());
            return redirect()->route('{$modelNameLower}.index')->with('success', 'Thêm thành công!');
        }

        public function edit(\${$modelNameLower})
        {
            return view('{$modelNameLower}.edit', compact('{$modelNameLower}'));
        }

        public function update(Request \$request, \${$modelNameLower})
        {
            \${$modelNameLower}->update(\$request->all());
            return redirect()->route('{$modelNameLower}.index')->with('success', 'Cập nhật thành công!');
        }

        public function destroy(\${$modelNameLower})
        {
            \${$modelNameLower}->delete();
            return redirect()->route('{$modelNameLower}.index')->with('success', 'Xóa thành công!');
        }
    }
    PHP;

        File::put($controllerPath, $controllerContent);
    }
    private function generateViews($modelNameLower)
    {
        $viewPath = resource_path("views/{$modelNameLower}");

        if (!File::exists($viewPath)) {
            File::makeDirectory($viewPath, 0755, true);
        }

        File::put($viewPath . '/index.blade.php', "<h1>Danh sách {$modelNameLower}</h1>");

        File::put($viewPath . '/create.blade.php', "<h1>Thêm mới {$modelNameLower}</h1>");

        File::put($viewPath . '/edit.blade.php', "<h1>Sửa {$modelNameLower}</h1>");
    }

    
}
