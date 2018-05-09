<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Exports\CategoriesExport;
use App\Exports\CodesExport;
use App\Exports\PrivilegesExport;
use App\Exports\RolesExport;
use App\Exports\UsersExport;
use App\Exports\LogsExport;
use App\Exports\MembersExport;
use App\Exports\PrivilegeRoleMapsExport;
use App\Exports\DepartmentTreesExport;
use App\Exports\FamilyTreesExport;
use App\Exports\MemDeptMapsExport;

class ExportsController extends Controller {

    public function exportCategories() {
        return new CategoriesExport();
    }

    public function exportCodes() {
        return new CodesExport();
    }

    public function exportPrivileges() {
        return new PrivilegesExport();
    }

    public function exportRoles() {
        return new RolesExport();
    }

    public function exportUsers() {
        return new UsersExport();
    }

    public function exportLogs() {
        return new LogsExport();
    }

    public function exportMembers() {
        return (new MembersExport)->download('members.xlsx');
    }

    public function exportPrivilegeRoleMaps() {
        return new PrivilegeRoleMapsExport();
    }

    public function exportDepartmentTrees() {
        return new DepartmentTreesExport();
    }

    public function exportFamilyTrees() {
        return new FamilyTreesExport();
    }

    public function exportMemDeptMaps() {
        return new MemDeptMapsExport();
    }
}
