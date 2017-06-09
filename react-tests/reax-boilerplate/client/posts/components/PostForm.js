import React from 'react'
import Form from 'reax-commons/lib/components/Form'
import FormGroup from 'reax-commons/lib/components/FormGroup'
import Label from 'reax-commons/lib/components/Label'
import TextInput from 'reax-commons/lib/components/TextInput'
import TextArea from 'reax-commons/lib/components/TextArea'
import Button from 'reax-commons/lib/components/Button'
import Spinner from 'reax-commons/lib/components/Spinner'
import { reduxForm } from 'redux-form'

function PostForm({
  fields: {
    title,
    body
  },
  pristine,
  submitting,
  handleSubmit,
  resetForm
}) {
  return (
    <Form onSubmit={handleSubmit}>
      <FormGroup error={title.touched && title.error}>
        <Label>Title</Label>
        <TextInput {...title} disabled={submitting} autoFocus />
      </FormGroup>
      <FormGroup error={body.touched && body.error}>
        <Label>Body</Label>
        <TextArea {...body} value={body.value || ''} disabled={submitting} />
      </FormGroup>
      <Button type="primary" submit disabled={submitting}>
        {submitting ? <Spinner /> : 'Submit'}
      </Button>
      {' '}
      <Button disabled={pristine || submitting} onClick={resetForm}>
        Reset
      </Button>
    </Form>
  )
}

export default reduxForm(
  {
    form: 'post',
    fields: [
      'title',
      'body'
    ],
    validate: ({ title, body }) => ({
      title: !title && 'Required',
      body: !body && 'Required'
    }),
    touchOnBlur: false
  },
  (state, { title, body }) => ({
    initialValues: {
      title,
      body
    }
  })
)(PostForm)
