<?php

class StringsController extends Controller
{ 
	public function index()
	{
		$strings = Strings::factory('strings')->all();

		return $this->response($strings);
	}
	public function store()
	{
		if($this->request->has('string'))
		{
            $string = $this->request->input('string');
			
			$id = Strings::factory('strings')->insert(['string' => $string]);

			return $this->response(['id' => $id]);
		}
	}
	public function update($id)
	{
		$prepare = Strings::factory('strings');

		if($prepare->show($id) != NULL)
		{
		    $all = $this->request->all();

            $prepare->update($id, $all);

            $message = 'String with id= `' . $id . '` was updated';
        }
        else
        {
        	$message = 'String with id= `' . $id . '` doesn\'t exist';
        }

        return $this->response(['message' => $message]);
	}
	public function destroy($id)
	{
		$prepare = Strings::factory('strings');

		if($prepare->show($id) != NULL)
		{
		    $prepare->delete($id);

            $message = 'String with id= `' . $id . '` was deleted';
        }
        else
        {
        	$message = 'String with id= `' . $id . '` doesn\'t exist';
        }
        return $this->response(['message' => $message]);
	}
}