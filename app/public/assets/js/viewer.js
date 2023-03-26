import * as THREE from 'three';
import { OrbitControls } from 'controls';
class Viewer {
    scene;
    controls;
    renderer;
    constructor() {
        this.scene = new THREE.Scene();

        this.camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
        this.camera.position.set(7, 7, 7);
        this.camera.lookAt(this.scene.position);

        this.renderer = new THREE.WebGLRenderer();
        this.renderer.setSize( window.innerWidth, window.innerHeight );
        document.body.appendChild( this.renderer.domElement );

        this.controls = new OrbitControls( this.camera, this.renderer.domElement );

        // light
        let light1 = new THREE.PointLight( 0xffffff, 0.7, 5000 );
        light1.position.set( 0, 8, 0 );
        this.scene.add( light1 );

        let light2 = new THREE.PointLight( 0xffffff, 0.6, 5000 );
        light2.position.set( 0, -8, 0 );
        this.scene.add( light2 );

        let light3 = new THREE.PointLight( 0xffffff, 0.5, 5000 );
        light3.position.set( 0, 0, 8 );
        this.scene.add( light3 );

        let light4 = new THREE.PointLight( 0xffffff, 0.5, 5000 );
        light4.position.set( 0, 0, -8 );
        this.scene.add( light4 );

        let light5 = new THREE.PointLight( 0xffffff, 0.3, 5000 );
        light5.position.set( 8, 0, 0 );
        this.scene.add( light5 );

        let light6 = new THREE.PointLight( 0xffffff, 0.3, 5000 );
        light6.position.set( -8, 0, 0 );
        this.scene.add( light6 );

        let light = new THREE.AmbientLight(0x555555);
        this.scene.add(light);

        this.animate();

    }

    animate() {
        requestAnimationFrame( this.animate.bind(this) );

        //mesh.rotation.x += 0.01;
        //mesh.rotation.y += 0.01;
        this.controls.update();
        this.renderer.render( this.scene, this.camera );
    }
    drawMesh(vertices, colorCode = 0x6CD51C)
    {
        let points = [];
        for(let i = 0; i < vertices.length; i=i+3) {
            points.push(new THREE.Vector3(vertices[i], vertices[i+1], vertices[i+2]));


            /*let geometry = new THREE.SphereGeometry(0.03, 32, 16);
            let material = new THREE.MeshStandardMaterial( { color: 0xD64121 } );//red
            let sphere = new THREE.Mesh( geometry, material );
            sphere.position.set(vertices[i], vertices[i+1], vertices[i+2]);
            this.scene.add( sphere );*/
        }
        let color = new THREE.Color(colorCode);
        let materialOptions = {
            //wireframe: true,
            side: THREE.DoubleSide,
            color: color,
        };
        let material = new THREE.MeshStandardMaterial(materialOptions);
        let geometry = new THREE.BufferGeometry();
        geometry.setFromPoints(points);
        geometry.computeVertexNormals();

        let mesh = new THREE.Mesh(geometry, material);
        this.scene.add(mesh);

        return mesh.geometry.uuid;

    }

    drawGroup(object)
    {
        for(let i = 0; i < object.length; i++) {
            this.drawMesh(object[i].vertices, object[i].color);
        }
    }

    removeMesh(uuid) {
        let object = this.scene.getObjectByProperty( 'uuid', uuid );
        object.geometry.dispose();
        object.material.dispose();
        this.scene.remove( object );
        this.renderer.renderLists.dispose();
    }

}
export default Viewer;