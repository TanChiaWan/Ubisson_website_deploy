namespace App\Imports;

use App\Models\Professional;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class UsersImport implements ToModel
{
    public function model(array $row)
{
    // Assuming the columns in the Excel file are in order
    return new Professional([
        'organizationid_FK' => $row[0],
        'organization_name' => $row[1],
        'professional_name' => $row[2],
        'professional_gender' => $row[3],
        'professional_mobile_phone' => $row[4],
        'professional_image' => $row[5],
        'username' => $row[6], // Assuming username is in the 7th column
        'password' => bcrypt($row[7]), // Assuming plain password is in the 8th column
        'plain_password' => $row[7],
        'remember_token' => $row[8],
        'professional_email_address' => $row[9],
        'professional_type_of_profession' => $row[10],
        'professional_account_role' => $row[11],
        'status' => $row[12],
    ]);
}
}
