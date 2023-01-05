var width = document.getElementById('thumbnail').clientWidth;
var height = document.getElementById('thumbnail').clientHeight;
var _3d = localStorage._3d == 'enabled';
var camera;
var scene;
var renderer;
var container;
var model;
var texture;

$(() => {
    const meta = 'meta[name="item-info"]';
    model = $(meta).attr('data-model');
    texture = $(meta).attr('data-texture');

    init();

    if (_3d) {
        $('#thumbnail').hide();
        $('#canvas').show();
        $('#3dButton').hide();
        $('#2dButton').show();
    }

	$('#3dButton').click(function() {
		_3d = true;
        localStorage._3d = 'enabled';

		$('#thumbnail').hide();
        $('#canvas').show();
        $('#3dButton').hide();
        $('#2dButton').show();
	});

    $('#2dButton').click(function() {
		_3d = false;
        localStorage._3d = 'disabled';

		$('#thumbnail').show();
        $('#canvas').hide();
        $('#3dButton').show();
        $('#2dButton').hide();
	});
});

function init() {
	container = document.getElementById('canvas');
	container.innerHTML = '';

	camera = new THREE.PerspectiveCamera(70, 1, 0.01, 100);
	camera.position.set(-1, 1.5, 1.5);

	scene = new THREE.Scene();

	renderer = new THREE.WebGLRenderer({
		antialias: true,
		alpha: true
	});

	renderer.setSize(width, height);

	controls = new THREE.OrbitControls(camera, renderer.domElement);
	controls.minDistance = 1.1;
	controls.maxDistance = 5;
	controls.enablePan = false;
	controls.update();

	var objLoader = new THREE.OBJLoader();

    objLoader.load(model, function(object) {
		var ambientLight = new THREE.AmbientLight(0xcccccc, 1.2);
		scene.add(ambientLight);

		object.position.set(0, 0, 0);

		var loader = new THREE.TextureLoader();

        loader.load(texture, function(texture) {
			object.traverse(function(child) {
				if (child instanceof THREE.Mesh)
					child.material.map = texture;
			});

			scene.add(object);
			fitCameraToObject(camera, object, 5, controls);

			renderer.setSize(width, height);
			renderer.render(scene, camera);

			controls.update();
		}, undefined, function(err) {
			console.error('Error loading texture.');
		});
	});

	container.appendChild(renderer.domElement);
	animate();
}

function fitCameraToObject(camera, object, offset, controls) {
	offset = offset || 1.25;

	const boundingBox = new THREE.Box3();
	boundingBox.setFromObject(object);

	const center = boundingBox.getCenter();
	const size = boundingBox.getSize();
	const maxDim = Math.max(size.x, size.y, size.z);
	const fov = camera.fov * (Math.PI / 180);

	var cameraZ = Math.abs(maxDim / 4 * Math.tan(fov * 2));
	cameraZ *= offset;
	camera.position.z = cameraZ;

	const minZ = boundingBox.min.z;
	const cameraToFarEdge = (minZ < 0) ? -minZ + cameraZ : cameraZ - minZ;

	camera.far = cameraToFarEdge * 3;
	camera.updateProjectionMatrix();

	if (controls) {
		controls.target = center;
		controls.maxDistance = cameraToFarEdge * 2;
		controls.saveState();
	} else {
		camera.lookAt(center)
	}
}

function animate() {
	onWindowResize();
	requestAnimationFrame(animate);
}

function onWindowResize() {
    camera.aspect = 1;
	camera.updateProjectionMatrix();
	renderer.setSize(width, height);
	renderer.render(scene, camera);
}

window.addEventListener('resize', onWindowResize, false);
