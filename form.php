<?php
class Form
{    
    var string $action;    //"var" anahtar sözcüğü, bir sınıfın değişkenlerini veya özelliğini bildirirken public ile aynıdır.
    var string $method; 
    var array $fields=[];
    
    private function __construct($action, $method) 
    {
        $this->action = $action; //burada const'ile nesnemizi ilk kullanıma hazırlıyoruz
        $this->method = $method;//ve burada da ..
    }


    public static function createGetForm($action)  
    {
        return self ::createForm($action,"GET");    //const(sabit) ve staticlerde self:: kullanılır, değişkenlerde this->
    }
    public static function createForm($action,$method) 
    {
        return new Form($action,$method);           //const(sabit) ve staticlerde self:: kullanılır, değişkenlerde this->
    }
    public static function createPostForm($action)  
    {
        return self ::createForm($action,"POST");   //const(sabit) ve staticlerde self:: kullanılır, değişkenlerde this->
    }



    public function addField(string $title, string $value, ?string $defaultValue = null) //addField için parametreler (başlık,değer ve varsa default atanmış değer)-->app.php 14.satır
    { 
        $fields=[$title,$value,$defaultValue];   //fields[] 'a değer eklenir

        $this->fields[]=$fields; 
    }

    public function setMethod($method)  //method set edildi
    {
        $this->method = $method;  
    }

    public function render()  //burada ekrana yazdırma ile ilgili gerekli işlemler yapıldı html ile birlikte
    { 

        foreach ($this->fields as $value) {
            echo "<form method='" . $this->method . "' action='" . $this->action . "'>\n";


           echo "    <label for='" . $value[1] . "'>" . $value[0] . "</label>\n";
            if(isset($value[2])){   //bu 'if' age ve türevleri için
                echo "    <input type='text' name='" . $value[1] . "' placeholder='" .$value[2]. "' />\n"; 
            }
            else{
                echo "    <input type='text' name='" . $value[1] . "' placeholder='enter value' />\n";
            }
        }
        echo "    <button type='submit'>Post</button>\n</form>\n";
    }
}

//<input type="checkbox" disabled="disabled" checked="checked" name="is_ok" value="bike" id="id_is_ok"/>

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */
