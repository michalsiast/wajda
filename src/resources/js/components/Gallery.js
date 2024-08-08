import React, {Component} from 'react';
import {CKEditor} from '@ckeditor/ckeditor5-react';
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import ReactDOM from 'react-dom';
import {Modal} from "react-bootstrap";
import {
    deleteGalleryItem,
    getGalleryById,
    getGalleryItemPathById,
    storeGalleryItem,
    updateGalleryItem
} from "../actions";

const galleryElement = document.getElementById('gallery');
const galleryId = document.querySelector('input[name="gallery_id"]').value;

class GalleryContainer extends Component {
    constructor(props) {
        super(props);

        this.state = {
            items: [],
            item: null,
            showItemPopup: false,
            types: ['item', 'cover', 'support', 'gallery', 'slider'],
            loadImageShow: false
        }

        this.table = React.createRef();
    }

    componentDidMount() {
        this.getItems();
    }

    getItems() {
        getGalleryById(galleryId).then(res => {
            this.setState({items: res.data.items})
        })
            .catch(err => {
                console.log(err);
            })
    }

    handleShowPopup(show = true, item = null) {
        this.setState({showItemPopup: show, item: item})
    }

    handlePopupSave() {
        this.handlePopupClose(() => {
            this.getItems()
        });
    }

    handlePopupClose(callback = null) {
        this.setState({
            showItemPopup: false,
            item: null,
        }, () => {
            if (typeof callback === 'function')
                callback();
        })
    }

    handleDeleteItem(id) {
        deleteGalleryItem(id).then(res => {
            if (res.data.status === 200) {
                let items = [...this.state.items];
                const index = items.findIndex(item => item.id === id);
                if (index !== -1) {
                    items.splice(index, 1);
                    this.setState({
                        items,
                    })
                }
            }
        })
    }

    render() {
        return (
            <div>
                <div className="card">
                    <div className="card-header">
                        Galeria
                        <div>
                            <button className="btn btn-primary"
                                    onClick={() => this.handleShowPopup(true, null)}>Dodaj
                            </button>
                            <Popup show={this.state.showItemPopup}
                                   item={this.state.item}
                                   types={this.state.types}
                                   handleClose={() => this.handlePopupClose()}
                                   handleSave={() => this.handlePopupSave()}
                            />
                        </div>
                    </div>
                    <div className="card-body">

                        <table className="table table-striped tableGallery sortable" data-table="gallery_item"
                               data-order="asc">
                            <thead>
                            <tr>
                                <th style={{width: 50}}>#</th>
                                <th style={{width: 130}}>Grafika</th>
                                <th>Nazwa</th>
                                <th>Typ</th>
                                <th>Widoczność</th>
                                <th/>
                            </tr>
                            </thead>
                            <tbody>
                            {this.state.items.length > 0 ? (
                                this.state.items.map((item, i) => (
                                    <Item key={item.id} index={i + 1}
                                          item={item}
                                          deleteItem={id => this.handleDeleteItem(id)}
                                          handleEdit={() => this.handleShowPopup(true, item)}/>
                                ))
                            ) : (
                                <tr>
                                    <td colSpan="100">
                                        <p>Brak dodanych elementów</p>
                                    </td>
                                </tr>
                            )}
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        )
    }
}


class Item extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <tr data-id={this.props.item.id}>
                <td data-position>{this.props.index}</td>
                <td>
                    <img src={this.props.item.url} alt={this.props.item.name} className="img-fluid"
                         style={{width: 40}}/>
                </td>
                <td>{this.props.item.name}</td>
                <td>{this.props.item.type}</td>
                <td>
                    {this.props.item.active ? (
                        <span className="badge badge-success">Active</span>
                    ) : (
                        <span className="badge badge-warning">Not active</span>
                    )}
                </td>
                <td className="text-right">
                    <button className="btn btn-info btn-sm mr-1" onClick={() => this.props.handleEdit()}>
                        <i data-feather="edit-2" className="mr-2"/>Edit
                    </button>
                    <button className="btn btn-danger btn-sm" onClick={() => this.props.deleteItem(this.props.item.id)}>
                        <i data-feather="trash" className="mr-2"/>Delete
                    </button>
                </td>
            </tr>
        );
    }
}


class Popup extends Component {
    constructor(props) {
        super(props);

        this.state = {
            img: null,
            files: [],
            filesPreview: [],
            name: '',
            type: props.types[0] ?? null,
            text: '',
            active: 1,
            invalidFeedback: '',
        };
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (prevProps.item !== this.props.item) {
            this.setState({
                name: this.props.item?.name ?? '',
                type: this.props.item?.type ?? 'item',
                text: this.props.item?.text ?? '',
                active: this.props.item?.active,
            })
        }
    }

    handleUploadFile(e) {
        const files = Array.from(e.target.files);
        let valid = [];
        let invalidFeedback = '';
        let countItems = 0;
        let loadingSuccessItems = 0;
        let loadingFailItems = 0;

        if (files.length > 400) {
            alert('Można dodać maksylanie 400 zdjęć za jednym razem!')
            return [];
        }
        files.map(file => {
            if (file.size > 20 * 1024 * 1024) {
                loadingFailItems++
                invalidFeedback = 'Plik [' + file.name + '] (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB) jest za duży (Maks 20MB).'
                document.querySelector('.addImages__fail span').textContent = loadingFailItems.toString();
                if(files.length === 1){
                    setTimeout(() => {
                        document.getElementsByClassName('loaderImages')[0].style.display = "none";
                    }, 1000)
                }
            } else {
                document.getElementsByClassName('loaderImages')[0].style.display = "flex";
                valid.push(file);
            }
        })
        countItems = valid.length;
        document.getElementsByClassName('loaderImages')[0].style.display = "flex";
        document.getElementsByClassName('loaderImages__all')[0].textContent = countItems.toString();

        this.setState({
            files: valid,
            invalidFeedback
        }, () => {
            this.state.files.map(file => {
                let reader = new FileReader();

                reader.onload = (e) => {
                    let arr = this.state.filesPreview;
                    arr.push(e.target.result)
                    this.setState({filesPreview: arr});
                    loadingSuccessItems++;
                    document.getElementsByClassName('loaderImages__progress')[0].textContent = loadingSuccessItems.toString();
                    if (countItems === loadingSuccessItems) {
                        setTimeout(() => {
                            document.getElementsByClassName('loaderImages')[0].style.display = "none";
                        }, 1000)
                    }
                }
                reader.readAsDataURL(file);

            })
        });
    }

    handleSubmit(e) {
        e.preventDefault();

        const formDates = [];
        let addedImages = 0;
        let failsImages = 0;
        this.state.files.map(file => {
            const formData = new FormData();

            formData.append('name', this.state.name);
            formData.append('type', this.state.type);
            formData.append('text', this.state.text);
            formData.append('active', this.state.active);
            formData.append('files[]', file);

            formDates.push(formData);
        })

        const allFiles = this.state.files.length;
        if (allFiles > 0) {
            document.getElementsByClassName('buttonAccept')[0].style.display = "none";
            document.getElementsByClassName('addImages')[0].style.display = "flex";
            const test = document.getElementsByClassName('addImages__all')[0];
            if(!!test) document.getElementsByClassName('addImages__all')[0].textContent = allFiles ?? 0;
        }


        if (this.props.item) {
            if (!formDates.length) {
                let newFormData = new FormData();

                this.state.files.map(file => {
                    newFormData.append('files[]', file);
                })

                newFormData.append('name', this.state.name);
                newFormData.append('type', this.state.type);
                newFormData.append('text', this.state.text);
                newFormData.append('active', this.state.active);

                updateGalleryItem(newFormData, this.props.item.id)
                    .then(res => {
                        this.setState({
                            filesPreview: [],
                            files: [],
                            name: '',
                            type: 'item',
                            text: '',
                            active: 1,
                        }, () => {
                            this.props.handleSave();
                        })
                    })
                    .catch(err => {
                        this.setState({
                            invalidFeedback: err.response?.data?.message,
                        })
                    })
            } else {
                Promise.all(formDates.map((formData) => updateGalleryItem(formData, this.props.item.id).then(r => {
                        addedImages++
                        document.getElementsByClassName('addImages__progress')[0].textContent = (addedImages + failsImages).toString();
                        if (addedImages === allFiles + failsImages) {
                            setTimeout(() => {
                                document.getElementsByClassName('addImages')[0].style.display = "none";
                                this.props.handleSave();
                            }, 1000)
                        }
                    }).catch(err => {
                        failsImages++
                        document.getElementsByClassName('addImages__failSend')[0].querySelector('span').textContent = failsImages.toString();
                        document.getElementsByClassName('addImages__progress')[0].textContent = (addedImages + failsImages).toString();

                        if (addedImages === allFiles + failsImages) {
                            setTimeout(() => {
                                document.getElementsByClassName('addImages')[0].style.display = "none";
                                this.props.handleSave();
                            }, 1000)
                        }
                    })
                ))
                    .then(res => {
                        this.setState({
                            filesPreview: [],
                            files: [],
                            name: '',
                            type: 'item',
                            text: '',
                            active: 1,
                        }, () => {
                            this.props.handleSave();
                        })
                    })
                    .catch(err => {
                        this.setState({
                            invalidFeedback: err.response?.data?.message,
                        })
                    })
            }
        } else {
            Promise.all(formDates.map((formData) => {
                storeGalleryItem(formData, galleryId).then(r => {
                    addedImages++
                    document.getElementsByClassName('addImages__progress')[0].textContent = (addedImages + failsImages).toString();
                    if (addedImages + failsImages === allFiles) {
                        setTimeout(() => {
                            document.getElementsByClassName('buttonAccept')[0].style.display = "block";
                            document.getElementsByClassName('addImages__body')[0].querySelector('p').innerHTML = `Dodawanie zakończone! <br> Dodano: ${addedImages} zdjęć <br> Nie dodano: ${failsImages} zdjęć`
                            this.props.handleSave();
                        }, 1000)
                    }

                    if (allFiles === 0) {
                        this.props.handleSave();
                    }
                }).catch(err => {
                    failsImages++
                    document.getElementsByClassName('addImages__failSend')[0].querySelector('span').textContent = failsImages.toString();
                    document.getElementsByClassName('addImages__progress')[0].textContent = (addedImages + failsImages).toString();
                    if (addedImages + failsImages === allFiles) {
                        setTimeout(() => {
                            document.getElementsByClassName('buttonAccept')[0].style.display = "block";
                            document.getElementsByClassName('addImages__body')[0].querySelector('p').innerHTML = `Dodawanie zakończone! <br> Dodano: ${addedImages} zdjęć <br> Nie dodano: ${failsImages} zdjęć`
                            this.props.handleSave();
                        }, 1000)
                    }
                })
            })).then(res => {
                this.setState({
                    filesPreview: [],
                    files: [],
                    name: '',
                    type: 'item',
                    text: '',
                    active: 1,
                }, () => {

                })

            })
                .catch(err => {
                    this.setState({
                        invalidFeedback: err.response?.data?.message,
                    })
                })

        }


    }

    removeAll() {
        this.setState({
            filesPreview: [],
            files: [],
        })
    }

    removePrevItem(e, index) {
        e.preventDefault();
        let filesPreview = [...this.state.filesPreview];
        let files = [...this.state.files];

        filesPreview.splice(index, 1);
        files.splice(index, 1);
        this.setState({
            filesPreview,
            files,
        })
    }

    closeModal() {
       window.location.reload()
        // document.getElementsByClassName('addImages')[0].style.display = "none";
    }

    render() {
        return (
            <>
                <div className="addImages" style={{
                    position: "fixed",
                    top: 0,
                    left: 0,
                    right: 0,
                    bottom: 0,
                    background: 'rgba(0,0,0,0.9)',
                    zIndex: 1060,
                    display: this.props.loadImageShow ? 'flex' : 'none',
                    alignItems: "center",
                    justifyContent: "center",
                    textAlign: "center",
                    fontSize: "1.5rem"
                }}>
                    <div className="addImages__body" style={{color: "white"}}>
                        <p>Dodawanie zdjęć.. Proszę czekać..<br/> <span className="addImages__progress">0</span>/<span
                            className="addImages__all">0</span>
                            <br/> <small className="addImages__failSend">Nie udało się
                                wgrać <span>0</span> zdjęć</small>
                        </p>
                        <button className="buttonAccept" onClick={this.closeModal}
                                style={{display: 'none', margin: '0 auto'}}>ZAMKNIJ
                        </button>
                    </div>
                </div>
                <div className="loaderImages" style={{
                    position: "fixed",
                    top: 0,
                    left: 0,
                    right: 0,
                    bottom: 0,
                    background: 'rgba(0,0,0,0.9)',
                    zIndex: 1060,
                    display: this.props.loadImageShow ? 'flex' : 'none',
                    alignItems: "center",
                    justifyContent: "center",
                    textAlign: "center",
                    fontSize: "1.5rem"
                }}>
                    <div className="loaderImages__body" style={{color: "white"}}>
                        <p>Dodawanie zdjęć do kolejki <br/> <span className="loaderImages__progress">0</span>/<span
                            className="loaderImages__all">0</span>
                            <br/> <small className="addImages__fail">Nie udało się
                                załadować <span>0</span> zdjęć</small>
                        </p>
                    </div>
                </div>
                <Modal size="lg" show={this.props.show} onHide={() => this.props.handleClose()}>
                    <form onSubmit={e => this.handleSubmit(e)}>
                        <Modal.Header closeButton>
                            <Modal.Title>Dodawanie/Edycja zdjęć</Modal.Title>
                        </Modal.Header>
                        <Modal.Body>

                            <div className="row">
                                <div className="col-md-6">
                                    {this.props.item ? (
                                        <div className="mb-3">
                                            <img src={this.props.item.url} alt="" className="img-fluid"/>
                                        </div>
                                    ) : null}

                                    {this.state.filesPreview?.length > 0 ? (
                                        <div className="d-flex justify-content-between align-content-center mb-3">
                                            <span>Items</span>
                                            <button className="btn btn-sm btn-danger"
                                                    onClick={() => this.removeAll()}>Usuń wszystkie
                                            </button>
                                        </div>
                                    ) : null}

                                    <div className="row" style={{rowGap: 25}}>
                                        {this.state.filesPreview.map((url, i) => (
                                            <div key={i} className="col-6 col-sm-4">
                                                <div className="prevImg">
                                                    <img src={url} alt="" className="img-fluid"/>
                                                    <button className="prevImg__btn"
                                                            onClick={e => this.removePrevItem(e, i)}>X
                                                    </button>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <div className="form-group">
                                        <div className="custom-file">
                                            <label htmlFor="file" className="custom-file-label">Pliki</label>
                                            <input type="file" id="file"
                                                   onChange={e => this.handleUploadFile(e)}
                                                   className="custom-file-input" multiple={!this.props.item}
                                                   accept={'image/*'}
                                            />
                                        </div>
                                        {this.state.invalidFeedback.length > 0 ? (
                                            <div className="invalid-feedback"
                                                 style={{display: 'block'}}>{this.state.invalidFeedback}</div>
                                        ) : null}
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="name">Nazwa</label>
                                        <input type="text" id="name"
                                               value={this.state.name}
                                               onChange={e => this.setState({name: e.target.value})}
                                               className="form-control"/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="type">Typ</label>
                                        <select name="type" id="type"
                                                onChange={e => this.setState({type: e.target.value})}
                                                className="custom-select">
                                            {this.props.types.map(type => (
                                                <option key={type} value={type}
                                                        selected={type === this.state.type}>{type}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div className="form-group">
                                        <div className="form-check">
                                            <input id="active" name="active" type="checkbox"
                                                   checked={this.state.active}
                                                   onChange={v => this.setState({active: Number(v.target.checked)})}
                                                   className="form-check-input"/>
                                            <label htmlFor="active" className="form-check-label">Widoczny</label>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="form-group">
                                <label htmlFor="text">Tekst</label>
                                <CKEditor editor={ClassicEditor}
                                          data={this.state.text}
                                          onReady={editor => {
                                              editor.setData(this.state.text);
                                          }}
                                          onChange={(event, editor) => {
                                              this.setState({text: editor.getData()})
                                          }}
                                />
                            </div>
                        </Modal.Body>
                        <Modal.Footer>
                            <button className="btn btn-primary" onClick={() => this.props.handleClose()}>Close</button>
                            <input type="submit" className="btn btn-secondary" value="Save"/>
                        </Modal.Footer>
                    </form>
                </Modal>
            </>
        )
    }
}


ReactDOM.render(<GalleryContainer/>, galleryElement);
