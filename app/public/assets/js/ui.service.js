import Viewer from 'viewer';
class UIService {
    viewer;
    controls;
    renderer;
    vehicle;

    currentChassisIndex = 0;
    currentHullIndex = 0;
    currentTurretIndex = 0;
    currentGunIndex = 0;
    colorMap = [];
    constructor() {
        this.vehicle = JSON.parse(document.getElementsByName('vehicle')[0].value);
        this.viewer = new Viewer();
        this.showVehicle();

    }

    showVehicle() {
        this.generateColorMap();
        this.showChassis();
        this.showHull();
        this.showTurret();
        this.showGun();
    }

    showChassis() {
        let chassis = this.vehicle.chassis[this.currentChassisIndex]['armor'];
        let groups = this.prepareGroups(chassis);
        this.viewer.drawGroup(groups);
    }

    showHull() {

        let hull = this.vehicle.hull[this.currentHullIndex]['armor'];
        let position = this.vehicle.chassis[this.currentChassisIndex]['armor']['hullPosition'];
        let groups = this.prepareGroups(hull, position);
        this.viewer.drawGroup(groups);
    }

    showTurret() {
        let turret = this.vehicle.turret[this.currentTurretIndex]['armor'];
        let hullPosition = this.vehicle.chassis[this.currentChassisIndex]['armor']['hullPosition'];
        let turretPosition = this.vehicle.hull[this.currentHullIndex]['armor']['turretPosition'];
        let position = this.sumArray(hullPosition, turretPosition);
        let groups = this.prepareGroups(turret, position);
        this.viewer.drawGroup(groups);
    }

    showGun() {
        let gun = this.vehicle.turret[this.currentTurretIndex]['gun'][this.currentGunIndex]['armor'];
        let hullPosition = this.vehicle.chassis[this.currentChassisIndex]['armor']['hullPosition'];
        let turretPosition = this.vehicle.hull[this.currentHullIndex]['armor']['turretPosition'];
        let gunPosition = this.vehicle.turret[this.currentTurretIndex]['armor']['gunPosition'];
        let position = this.sumArray(hullPosition, turretPosition, gunPosition);
        let groups = this.prepareGroups(gun, position);
        this.viewer.drawGroup(groups);
    }

    prepareGroups(object, position = [0,0,0]) {
        let groups = object.objects.armor.groups;
        let result = [];
        for(let i = 0; i < groups.length; i++ ) {
            let material = groups[i]['material'];
            if(material == 'surveyingDevice') {
                continue;
            }
            let tmp = {
                vertices: [],
                thickness: object.materials[material],
                isPrimary: object.primaryArmor.includes(material),
                color: this.colorMap[parseInt(object.materials[material])]
            }

            for(let j = 0; j < groups[i].indices.length; j++) {
                let index = groups[i].indices[j] * 3;
                tmp.vertices.push(
                    object['objects']['armor']['vertices'][index] + position[0],
                    object['objects']['armor']['vertices'][index + 1] + position[1],
                    object['objects']['armor']['vertices'][index + 2] + position[2],
                );
            }
            result.push(tmp);
        }
        return result;
    }

    sumArray(...arrays) {
        const n = arrays.reduce((max, xs) => Math.max(max, xs.length), 0);
        const result = Array.from({ length: n });
        return result.map((_, i) => arrays.map(xs => xs[i] || 0).reduce((sum, x) => sum + x, 0));
    }

    generateColorMap() {
        let armor = this.collectArmorThickness();
        let gradient = this.generateColorGradient(armor.length);
        let result = {};
        for (let i = 0; i < armor.length; i++) {
            result[armor[i]] = gradient[i];
        }
        this.colorMap = result;
    }

    collectArmorThickness() {
        let chassis = this.vehicle.chassis[this.currentChassisIndex]['armor'].materials;
        let hull = this.vehicle.hull[this.currentHullIndex]['armor'].materials;
        let turret = this.vehicle.turret[this.currentTurretIndex]['armor'].materials;
        let gun = this.vehicle.turret[this.currentTurretIndex]['gun'][this.currentGunIndex]['armor'].materials;
        let vehicle = {
            ...chassis,
            ...hull,
            ...turret,
            ...gun
        };
        let result = Object.values(vehicle);
        result = result.map(a => parseInt(a));
        result = [...new Set(result)];

        result.sort(function(a, b) {
            return a - b;
        });
        return result;
    }
    generateColorGradient(count) {
        if(!count) {
            return colors;
        }
        let stepSize = Math.floor(510 / (count - 1));
        let colors = [];
        for (let i = 0; i < count; i++) {
            let step = i * stepSize;

            let r = step > 255 ? 255 : step;
            let g = step > 255 ? 255 - (step - 255) : 255;
            let b = 0;

            colors.push(`rgb(${r}, ${g}, ${b})`);
        }

        return colors;
    }

}
export default UIService;