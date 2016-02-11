import React from 'react';
import { reduxForm } from 'redux-form';
import Panel from '@hnordt/reax-panel';
import PanelBody from '@hnordt/reax-panel-body';
import Form from '@hnordt/reax-form';
import FormGroup from '@hnordt/reax-form-group';
import Label from '@hnordt/reax-label';
import TextInput from '@hnordt/reax-input';
import Button from '@hnordt/reax-button';
import Spinner from '@hnordt/reax-spinner';
import { isEmpty } from '@hnordt/reax-validator';

const ProjectForm = ({
  fields: { name },
  submitting,
  handleSubmit,
  resetForm
}) => (
  <Panel title="Add Project">
    <PanelBody>
      <Form onSubmit={handleSubmit(() => {
        alert('Form validation succeeded');
        resetForm();
      })}>
        <FormGroup error={name.touched && name.error}>
          <Label>Name</Label>
          <TextInput {...name} disabled={submitting} />
        </FormGroup>
        <Button type="primary" submit disabled={submitting}>
          {submitting ? <Spinner /> : 'Save'}
        </Button>
      </Form>
    </PanelBody>
  </Panel>
);

export default reduxForm(
  {
    form: 'project',
    fields: ['name'],
    validate: ({ name }) => ({
      name: isEmpty(name) && 'Required'
    })
  }
)(ProjectForm);
