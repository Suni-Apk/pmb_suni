    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('biayas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_angkatans');
                $table->foreignId('id_jurusans')->nullable();
                $table->foreignId('id_kursus')->nullable();
                $table->string('nama_biaya');
                $table->string('jenis_biaya');
                $table->enum('program_belajar', ['S1', 'KURSUS']);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('biayas');
        }
    };
