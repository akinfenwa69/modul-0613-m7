<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuarios
        DB::table('users')->insert([
            // Clientes
            ['nom'=>'Laura','cognom'=>'Pérez','email'=>'laura.perez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600123456','rol'=>'CLIENT','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Marc','cognom'=>'Gómez','email'=>'marc.gomez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600654321','rol'=>'CLIENT','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'María','cognom'=>'García','email'=>'maria.garcia@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600333444','rol'=>'CLIENT','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Pedro','cognom'=>'López','email'=>'pedro.lopez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600987654','rol'=>'CLIENT','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Sofía','cognom'=>'Ramírez','email'=>'sofia.ramirez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600222333','rol'=>'CLIENT','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Diego','cognom'=>'Martínez','email'=>'diego.martinez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600444555','rol'=>'CLIENT','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Lucía','cognom'=>'Fernández','email'=>'lucia.fernandez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600666777','rol'=>'CLIENT','created_at'=>now(),'updated_at'=>now()],

            // Monitores
            ['nom'=>'Juan','cognom'=>'Pérez','email'=>'juan.perez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600111222','rol'=>'MONITOR','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'María','cognom'=>'Gómez','email'=>'maria.gomez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600333444','rol'=>'MONITOR','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Ana','cognom'=>'Sánchez','email'=>'ana.sanchez@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600567890','rol'=>'MONITOR','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Carlos','cognom'=>'Torres','email'=>'carlos.torres@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600888999','rol'=>'MONITOR','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Elena','cognom'=>'Ruiz','email'=>'elena.ruiz@gmail.com','password'=>Hash::make('PASsword123'),'telefon'=>'600555666','rol'=>'MONITOR','created_at'=>now(),'updated_at'=>now()],

            // Admins
            ['nom'=>'Admin','cognom'=>'Root','email'=>'admin@gmail.com','password'=>Hash::make('ADmin1234'),'telefon'=>'600000000','rol'=>'ADMIN','created_at'=>now(),'updated_at'=>now()],
            ['nom'=>'Super','cognom'=>'Admin','email'=>'super.admin@gmail.com','password'=>Hash::make('ADmin1234'),'telefon'=>'600111000','rol'=>'ADMIN','created_at'=>now(),'updated_at'=>now()],
        ]);

        // Sales
        DB::table('sales')->insert([
            ['tipus'=>'Fuerza','descripcio'=>'Sala para entrenamientos de fuerza','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Cardio','descripcio'=>'Sala para cardio y running','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Yoga','descripcio'=>'Sala tranquila para yoga y meditación','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Pilates','descripcio'=>'Sala para pilates y estiramientos','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Spinning','descripcio'=>'Sala con bicicletas estáticas','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Crossfit','descripcio'=>'Sala intensa para Crossfit','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Boxeo','descripcio'=>'Sala de boxeo y artes marciales','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Natación','descripcio'=>'Piscina para clases de natación','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Zumba','descripcio'=>'Sala de baile y zumba','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'HIIT','descripcio'=>'Sala para entrenamiento HIIT','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Stretching','descripcio'=>'Sala para estiramientos y movilidad','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Meditación','descripcio'=>'Sala silenciosa para meditación','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'BodyPump','descripcio'=>'Sala con barras y pesas para BodyPump','created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Ciclismo Indoor','descripcio'=>'Sala con bicicletas indoor','created_at'=>now(),'updated_at'=>now()],
        ]);

        // Clases
        DB::table('classes')->insert([
            ['tipus'=>'Yoga','descripcio'=>'Yoga básico para todos','horari_inici'=>'09:00:00','horari_final'=>'10:00:00','dia'=>now()->toDateString(),'places'=>15,'sala_id'=>3,'monitor_id'=>8,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Pilates','descripcio'=>'Pilates nivel intermedio','horari_inici'=>'10:30:00','horari_final'=>'11:30:00','dia'=>now()->toDateString(),'places'=>12,'sala_id'=>4,'monitor_id'=>9,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Spinning','descripcio'=>'Spinning intenso','horari_inici'=>'12:00:00','horari_final'=>'13:00:00','dia'=>now()->toDateString(),'places'=>20,'sala_id'=>5,'monitor_id'=>10,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Yoga','descripcio'=>'Yoga avanzado','horari_inici'=>'17:00:00','horari_final'=>'18:00:00','dia'=>now()->addDay()->toDateString(),'places'=>10,'sala_id'=>3,'monitor_id'=>11,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Crossfit','descripcio'=>'Entrenamiento Crossfit','horari_inici'=>'18:30:00','horari_final'=>'19:30:00','dia'=>now()->addDay()->toDateString(),'places'=>8,'sala_id'=>6,'monitor_id'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Boxeo','descripcio'=>'Clase de boxeo para principiantes','horari_inici'=>'08:00:00','horari_final'=>'09:00:00','dia'=>now()->addDay()->toDateString(),'places'=>12,'sala_id'=>7,'monitor_id'=>8,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Natación','descripcio'=>'Clase de natación para niños','horari_inici'=>'14:00:00','horari_final'=>'15:00:00','dia'=>now()->toDateString(),'places'=>10,'sala_id'=>8,'monitor_id'=>9,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Zumba','descripcio'=>'Zumba para adultos','horari_inici'=>'15:30:00','horari_final'=>'16:30:00','dia'=>now()->toDateString(),'places'=>20,'sala_id'=>9,'monitor_id'=>10,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'HIIT','descripcio'=>'Entrenamiento HIIT intenso','horari_inici'=>'16:30:00','horari_final'=>'17:30:00','dia'=>now()->toDateString(),'places'=>15,'sala_id'=>10,'monitor_id'=>11,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Stretching','descripcio'=>'Estiramientos y movilidad','horari_inici'=>'07:30:00','horari_final'=>'08:15:00','dia'=>now()->toDateString(),'places'=>12,'sala_id'=>11,'monitor_id'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Meditación','descripcio'=>'Clase de meditación guiada','horari_inici'=>'18:00:00','horari_final'=>'19:00:00','dia'=>now()->toDateString(),'places'=>8,'sala_id'=>12,'monitor_id'=>8,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'BodyPump','descripcio'=>'BodyPump con pesas','horari_inici'=>'19:00:00','horari_final'=>'20:00:00','dia'=>now()->toDateString(),'places'=>15,'sala_id'=>13,'monitor_id'=>9,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Ciclismo Indoor','descripcio'=>'Indoor cycling','horari_inici'=>'20:00:00','horari_final'=>'21:00:00','dia'=>now()->toDateString(),'places'=>18,'sala_id'=>14,'monitor_id'=>10,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Yoga','descripcio'=>'Yoga para relajación profunda','horari_inici'=>'08:30:00','horari_final'=>'09:30:00','dia'=>now()->toDateString(),'places'=>15,'sala_id'=>3,'monitor_id'=>11,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Pilates','descripcio'=>'Pilates avanzado con énfasis en postura','horari_inici'=>'11:00:00','horari_final'=>'12:00:00','dia'=>now()->addDays(2)->toDateString(),'places'=>12,'sala_id'=>4,'monitor_id'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Crossfit','descripcio'=>'Crossfit nivel intermedio','horari_inici'=>'13:00:00','horari_final'=>'14:00:00','dia'=>now()->addDays(2)->toDateString(),'places'=>10,'sala_id'=>6,'monitor_id'=>8,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Zumba','descripcio'=>'Zumba divertido y energético','horari_inici'=>'15:00:00','horari_final'=>'16:00:00','dia'=>now()->addDays(2)->toDateString(),'places'=>20,'sala_id'=>9,'monitor_id'=>9,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'HIIT','descripcio'=>'HIIT avanzado','horari_inici'=>'16:00:00','horari_final'=>'17:00:00','dia'=>now()->addDays(3)->toDateString(),'places'=>15,'sala_id'=>10,'monitor_id'=>10,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Natación','descripcio'=>'Natación para adultos','horari_inici'=>'09:00:00','horari_final'=>'10:00:00','dia'=>now()->addDays(3)->toDateString(),'places'=>12,'sala_id'=>8,'monitor_id'=>11,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Boxeo','descripcio'=>'Boxeo avanzado','horari_inici'=>'17:30:00','horari_final'=>'18:30:00','dia'=>now()->addDays(3)->toDateString(),'places'=>12,'sala_id'=>7,'monitor_id'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Stretching','descripcio'=>'Movilidad y estiramientos avanzados','horari_inici'=>'07:00:00','horari_final'=>'08:00:00','dia'=>now()->addDays(4)->toDateString(),'places'=>12,'sala_id'=>11,'monitor_id'=>8,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Meditación','descripcio'=>'Meditación profunda','horari_inici'=>'19:00:00','horari_final'=>'20:00:00','dia'=>now()->addDays(4)->toDateString(),'places'=>8,'sala_id'=>12,'monitor_id'=>9,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'BodyPump','descripcio'=>'BodyPump para fuerza','horari_inici'=>'18:00:00','horari_final'=>'19:00:00','dia'=>now()->addDays(4)->toDateString(),'places'=>15,'sala_id'=>13,'monitor_id'=>10,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Ciclismo Indoor','descripcio'=>'Ciclismo indoor avanzado','horari_inici'=>'20:30:00','horari_final'=>'21:30:00','dia'=>now()->addDays(4)->toDateString(),'places'=>18,'sala_id'=>14,'monitor_id'=>11,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Yoga','descripcio'=>'Yoga dinámico','horari_inici'=>'06:30:00','horari_final'=>'07:30:00','dia'=>now()->addDays(5)->toDateString(),'places'=>15,'sala_id'=>3,'monitor_id'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Pilates','descripcio'=>'Pilates matutino','horari_inici'=>'08:00:00','horari_final'=>'09:00:00','dia'=>now()->addDays(5)->toDateString(),'places'=>12,'sala_id'=>4,'monitor_id'=>8,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Spinning','descripcio'=>'Spinning para principiantes','horari_inici'=>'09:30:00','horari_final'=>'10:30:00','dia'=>now()->addDays(5)->toDateString(),'places'=>20,'sala_id'=>5,'monitor_id'=>9,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Reservas
        DB::table('reserves')->insert([
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>1,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>2,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>3,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>4,'client_id'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>5,'client_id'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>6,'client_id'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>7,'client_id'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>8,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>9,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>10,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>11,'client_id'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>12,'client_id'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>13,'client_id'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>14,'client_id'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>2,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>2,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>2,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>3,'client_id'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>3,'client_id'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['data_de_reserva'=>Carbon::now(),'classe_id'=>5,'client_id'=>6,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Valoracions
        DB::table('valoracions')->insert([
            ['descripcio'=>'Clase excelente','estrelles'=>5,'classe_id'=>1,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Buena clase, algo intensa','estrelles'=>4,'classe_id'=>2,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Difícil pero interesante','estrelles'=>3,'classe_id'=>3,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Muy relajante','estrelles'=>5,'classe_id'=>4,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Clase divertida','estrelles'=>4,'classe_id'=>5,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Me costó seguirla','estrelles'=>2,'classe_id'=>6,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Perfecta para principiantes','estrelles'=>5,'classe_id'=>7,'client_id'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Muy dinámica','estrelles'=>4,'classe_id'=>8,'client_id'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Intensa pero efectiva','estrelles'=>5,'classe_id'=>9,'client_id'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Me encantó la música','estrelles'=>5,'classe_id'=>10,'client_id'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Clase relajante y tranquila','estrelles'=>5,'classe_id'=>11,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Demasiado avanzada','estrelles'=>2,'classe_id'=>12,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Bien organizada','estrelles'=>4,'classe_id'=>13,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Muy motivadora','estrelles'=>5,'classe_id'=>14,'client_id'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Clases cortas pero efectivas','estrelles'=>4,'classe_id'=>2,'client_id'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Excelente para mejorar postura','estrelles'=>5,'classe_id'=>2,'client_id'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Muy entretenida','estrelles'=>4,'classe_id'=>2,'client_id'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Difícil pero valió la pena','estrelles'=>3,'classe_id'=>3,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Clase intensa y divertida','estrelles'=>5,'classe_id'=>3,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['descripcio'=>'Perfecta para relajar la mente','estrelles'=>5,'classe_id'=>5,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Targetas
        DB::table('targetas')->insert([
            ['nom_titular'=>'Laura Pérez','numero_compte'=>'4111111111111111','data_validesa'=>now()->addYear()->toDateString(),'cvv'=>'123','tipus_targeta'=>'VISA','activa'=>true,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'Marc Gómez','numero_compte'=>'5500000000000004','data_validesa'=>now()->addYear()->toDateString(),'cvv'=>'456','tipus_targeta'=>'MASTERCARD','activa'=>true,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'María García','numero_compte'=>'340000000000009','data_validesa'=>now()->addYear()->toDateString(),'cvv'=>'789','tipus_targeta'=>'AMEX','activa'=>true,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'Pedro López','numero_compte'=>'4111222233334444','data_validesa'=>now()->addYears(2)->toDateString(),'cvv'=>'321','tipus_targeta'=>'VISA','activa'=>true,'client_id'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'Sofía Ramírez','numero_compte'=>'5555666677778884','data_validesa'=>now()->addYears(2)->toDateString(),'cvv'=>'654','tipus_targeta'=>'MASTERCARD','activa'=>true,'client_id'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'Diego Martínez','numero_compte'=>'378282246310005','data_validesa'=>now()->addYears(3)->toDateString(),'cvv'=>'987','tipus_targeta'=>'AMEX','activa'=>true,'client_id'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'Lucía Fernández','numero_compte'=>'4111333344445555','data_validesa'=>now()->addYear()->toDateString(),'cvv'=>'147','tipus_targeta'=>'VISA','activa'=>true,'client_id'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'Juan Pérez','numero_compte'=>'5105105105105100','data_validesa'=>now()->addYears(2)->toDateString(),'cvv'=>'258','tipus_targeta'=>'MASTERCARD','activa'=>true,'client_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'María Gómez','numero_compte'=>'371449635398431','data_validesa'=>now()->addYears(3)->toDateString(),'cvv'=>'369','tipus_targeta'=>'AMEX','activa'=>true,'client_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['nom_titular'=>'Ana Sánchez','numero_compte'=>'4007000000027','data_validesa'=>now()->addYear()->toDateString(),'cvv'=>'159','tipus_targeta'=>'VISA','activa'=>true,'client_id'=>3,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Subscripcions
        DB::table('subscripcions')->insert([
            ['tipus'=>'Bàsica','preu'=>20.00,'data_inici'=>now()->toDateString(),'data_fi'=>now()->addMonth()->toDateString(),'client_id'=>1,'targeta_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Premium','preu'=>30.00,'data_inici'=>now()->toDateString(),'data_fi'=>now()->addMonth()->toDateString(),'client_id'=>2,'targeta_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'VIP','preu'=>50.00,'data_inici'=>now()->toDateString(),'data_fi'=>now()->addMonth()->toDateString(),'client_id'=>3,'targeta_id'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Bàsica','preu'=>20.00,'data_inici'=>now()->toDateString(),'data_fi'=>now()->addMonth()->toDateString(),'client_id'=>4,'targeta_id'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Premium','preu'=>30.00,'data_inici'=>now()->toDateString(),'data_fi'=>now()->addMonth()->toDateString(),'client_id'=>5,'targeta_id'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'VIP','preu'=>50.00,'data_inici'=>now()->toDateString(),'data_fi'=>now()->addMonth()->toDateString(),'client_id'=>6,'targeta_id'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Bàsica','preu'=>20.00,'data_inici'=>now()->toDateString(),'data_fi'=>now()->addMonth()->toDateString(),'client_id'=>7,'targeta_id'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Premium','preu'=>30.00,'data_inici'=>now()->addDays(1)->toDateString(),'data_fi'=>now()->addMonths(2)->toDateString(),'client_id'=>1,'targeta_id'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'VIP','preu'=>50.00,'data_inici'=>now()->addDays(1)->toDateString(),'data_fi'=>now()->addMonths(2)->toDateString(),'client_id'=>2,'targeta_id'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['tipus'=>'Bàsica','preu'=>20.00,'data_inici'=>now()->addDays(2)->toDateString(),'data_fi'=>now()->addMonths(2)->toDateString(),'client_id'=>3,'targeta_id'=>3,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}